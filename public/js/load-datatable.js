delete parameter;
var parameter = {
	datatable: config,
	type: type,
	key: key,
	search: function () { return $('input[type="search"]').val() },
}

var mediaKey = ['application', 'audio', 'video', 'image'];
$('[name="company_id"]').val(company_id)

if (config.filter.hasOwnProperty('table')) {
	for (let z = 0; z < config.filter.table.length; z++) {
		if (z > 0) {
			let tableFilterCheck = config.filter.table[z]
			if (tableFilterCheck.includes('as')) {
				tableFilterCheck = tableFilterCheck.split(' as ')[1]
			}

			parameter[tableFilterCheck] = function () { return $('[name="' + tableFilterCheck + '"]').val() }
		}
	}
}

if (config.filter.hasOwnProperty('between')) {
	let between = config.filter.between;
	for (let h = 0; h < between.length; h++) {
		for (let be in between[h]['value']) {
			parameter[be] = function () { return $('[name="' + be + '"]').val() }
		}
	}
}

if (config.hasOwnProperty('filterAuth')) {
	for (let a = 0; a < config.filterAuth.length; a++) {
		parameter[config.filterAuth[a]] = function () { return $('[name="' + config.filterAuth[a] + '"]').val() }
	}
}

$('.table-responsive').on('show.bs.dropdown', function () {
	$('.table-responsive').css("overflow", "inherit");
});

delete resDataTable;
var resDataTable = $('#dataTable').DataTable({
	"pageLength": 25,
	"processing": true,
	"serverSide": true,
	"ordering": false,
	"ajax": {
		url: getData,
		type: "post",
		data: parameter,
	},
	"columns": forTableData(),
	"dom": '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
	"language": {
		search: '<span>Filter:</span> _INPUT_',
		searchPlaceholder: 'Type to filter...',
		lengthMenu: '<span>Show:</span> _MENU_',
	},
	columnDefs: forColumnDefs(),
	initComplete: function (settings, json) {
		// if (json.data.length != 0 && configMenu.activity.indexOf('delete') > -1 && removable) {
		// 	$('.dataTables_filter').after('<div style="float:left" class="btn-select"><a href="javascript:void(0)" class="btn btn-default multi-delete" style="margin-left:10px;">Pilih Data</a></div>')
		// }
	}
});

$('.dataTables_filter').after('<div sstyle="display:inline-block;" class="btn-custom-header"><a href="javascript:void(0)" class="btn btn-default btn-show-filter btn-rounded"><i class="icon-filter4 position-left"></i> Filter</a></div>')

function forTableData() {
	let data = []
	let select = config.selectTable
	let label = config.labelTable
	for (let i = 0; i < label.length; i++) {
		let name = select[i]
		if (name.includes('as')) {
			let split = name.split(' as ')
			if (split.length > 1) {
				name = split[1]
			}
		}

		data.push({ data: name })
	}

	data.push({ data: 'id' })
	return data;
}

function multilang(data) {
	let exp = JSON.parse(data)
	return exp['en']
}

function forColumnDefs() {
	let data = [{
		targets: 0,
		createdCell: function (td, cellData, rowData, row, col) {
			if (configMenu.activity.indexOf('edit') > -1 && editable) {
				let existValue = cellData
				for (let lt = 0; lt < config.customLabel.length; lt++) {
					if (config.customLabel[lt].label == config.labelTable[0]) {
						if (config.customLabel[lt].template == 'multilang') {
							existValue = multilang(cellData)
						}
					}
				}
				$(td).html('<a class="me" href="' + currentUrl + '/entry/' + rowData.id + '" ><b>' + existValue + '</b></a>')
			} else {
				$(td).html('<b>' + cellData + '</b>')
			}

		},
	}, {
		targets: -1,
		orderable: false,
		createdCell: function (td, cellData, rowData, row, col) {
			let addHtml = ''
			let countActivity = 0
			if (config.hasOwnProperty('addAction')) {
				for (var i = 0; i < config.addAction.length; i++) {
					if (otherAccess == 1 || otherAccess.indexOf(config.addAction[i].key) > -1) {
						let mark = config.addAction[i].mark
						let setShow = false
						if (Array.isArray(mark.label)) {
							let setTempShow = []
							for (let z = 0; z < mark.label.length; z++) {
								if (Array.isArray(mark.value[z])) {
									setTempShow.push(mark.value[z][rowData[mark.label[z]]])
								} else {
									setTempShow.push(mark.value[z])
								}
							}
							setShow = setTempShow.every(v => v === true)
						} else {
							if (Array.isArray(mark.value)) {
								setShow = mark.value[rowData[mark.label]]
							} else {
								setShow = mark.value
							}
						}
						if (setShow) {
							let com = config.addAction[i]
							if (!com.hasOwnProperty('condition') || com.condition.value == rowData[com.condition.key]) {
								let useUrl = (com.base == 'currentUrl')
									? window[com.base]
									: baseUrl + '/' + com.base
								let href = com.href.replace('[base]', useUrl)
									.replace('[slug]', rowData.slug)
									.replace('[title]', encodeURI(rowData.title))
									.replace('[id]', rowData.id)
								addHtml += '<li>'
								addHtml += '<a href="' + href + '" target="' + com.target + '" class="' + com.class + '"><i class="' + com.icon + '"></i> ' + com.label + '</a>'
								addHtml += '</li>'

								countActivity++
							}
						}
					}
				}
			}

			let html = '<ul class="icons-list">' +
				'<li class="dropdown">' +
				'<a href="#" class="dropdown-toggle" data-toggle="dropdown">' +
				'<i class="icon-menu9"></i>' +
				'</a>' +
				'<ul class="dropdown-menu dropdown-menu-right">'

			if (configMenu.activity.indexOf('edit') > -1 && editable) {
				html += '<li><a href="' + currentUrl + '/entry/' + rowData.id + '" class="me"><i class="icon-pencil"></i> Edit</a></li>'
				countActivity++
			}

			if (configMenu.activity.indexOf('delete') > -1 && removable) {
				html += '<li><a href="' + currentUrl + '/delete/' + rowData.id + '" class="delete-data"><i class="icon-trash"></i> Hapus</a></li>'
				countActivity++
			}

			if (configMenu.activity.indexOf('trace') > -1 && traceable) {
				html += '<li><a href="' + currentUrl + '/trace/' + rowData.id + '" class="me"><i class="icon-search4"></i> Pelacakan</a></li>'
				countActivity++
			}

			html += addHtml
			html += '</ul></li></ul>'
			html = countActivity > 0 ? html : ''

			$(td).html(html).css('text-align', 'center')
		},
	}]

	if (config.hasOwnProperty('addTemplate')) {
		let keys = Object.keys(config.addTemplate)
		keys.map(function (i) {
			let component = config.addTemplate[keys]
			data.push({
				targets: config.selectTable.indexOf(i),
				createdCell: function (td, cellData, rowData, row, col) {
					if (cellData) {
						let value = cellData
						if (component.hasOwnProperty('default')) {
							value = component.default + cellData
							if (component.hasOwnProperty('prefix')) {
								let split = cellData.split('.')
								value = component.default + split[0] + component.prefix + '.' + split[1]
							}
						}

						$(td).html($(component.html).attr(component.tag, value))
					} else {
						$(td).html('')
					}
				}
			})
		})
	}

	if (config.hasOwnProperty("customLabel")) {
		for (let c = 0; c < config.customLabel.length; c++) {
			let template = config.customLabel[c]
			data.push({
				targets: config.labelTable.indexOf(template['label']),
				createdCell: function (td, cellData, rowData, row, col) {
					if (cellData !== '') {
						if (template['template'] == 'decimal') {
							$(td).html(formatRupiah(cellData))
						} else if (template['template'] == 'date') {
							let tempdate = cellData
							if (tempdate) {
								let split = tempdate.split(' ')
								tempdate = split.length > 0 ? split[0] : ''
							}

							$(td).html(formatDate(tempdate))
						} else if (template['template'] == 'datetime') {
							$(td).html(formatDateTime(cellData))
						} else if (template['template'] == 'longtext') {
							if (cellData != null) {
								$(td).html($(cellData).text().replace(/[\r\n]/g, '').substring(0, 100) + '...')
							} else {
								$(td).html('')
							}
						} else if (template['template'] == 'image') {
							let image = baseUrl + '/img/placeholder.jpg'
							if (cellData != null) {
								let tempImage = cellData.split('.')
								image = baseUrl + '/' + tempImage[0] + '-mini.' + tempImage[1]
							}

							$(td).html('<img src="' + image + '" height="70px;">')
						} else {
							$(td).html(template['template'][cellData]['html'])
						}
					} else {
						$(td).html('')
					}
				}
			})
		}
	}

	return data
}

function formatDate(date) {
	if (date) {
		let split = date.split('-')
		split.reverse()
		return split.join('/');
	}

	return date
}

function formatDateTime(datetime) {
	if (datetime) {
		let splitSpace = datetime.split(' ')
		let date = splitSpace[0].split('-')
		date.reverse()
		let newdate = date.join('/');

		return newdate + '<br><span style="font-size:11px">' + splitSpace[1] + '</span>'
	}

	return datetime
}

$('.filter-select2').on('select2:select', function () {
	$('#add-export-input').html('')
	paramExportExcel()
	resDataTable.ajax.reload(resetSelectRow())
})

$('.between').on('change', function () {
	$('#add-export-input').html('')
	paramExportExcel()
	resDataTable.ajax.reload(resetSelectRow())
})

$('.text').on('change', function () {
	$('#add-export-input').html('')
	paramExportExcel()
	resDataTable.ajax.reload(resetSelectRow())
})

$('.btn-show-filter').click(function () {
	$('.element-filter').slideToggle();
	$(this).toggleClass("btn-primary");
})

// $('[type=search]').attr('name','search')

// $('table').on('click','.child-data',function(){
// 	let parent = $(this).parents('tr')
// 	let length = parent.find('td').length - 1
// 	let child = $(this).data('child')
// 	if (!parent.next().hasClass('row-child')) {
// 		let html = '<tr class="row-child"><td class="child" colspan="'+length+'"><ul>';
// 		for (let i = 0; i < child.length; i++) {
// 			html += '<li style="margin-top:5px;"><a href="'+baseUrl+'/admin/modul/'+type+'/entry/'+child[i].id+'">'+child[i].title+'</a>';
// 		}

// 		html += '</ul></td><td class="text-center"><a href="javascript:void(0)" class="remove-child" style="color:red;font-size:17px;"><i class="lnr lnr-cross-circle"></i></a></td></tr>';
// 		parent.after(html)
// 	}else{
// 		parent.next().remove()
// 	}
// })

// $('table').on('click','.remove-child', function(){
// 	$(this).parents('tr').remove()
// })

// $('.modal-export').click(function(){
// 	$('#modal-export').modal('show')
// })

// $('.modal-import').click(function(){
// 	$('#modal-import').modal('show')
// })

// $('#export').submit(function(e){
// 	let html = '';
// 	Object.keys(parameter).forEach(function(index,val){
// 		if($('[name="'+index+'"]').length > 0){
// 			html += "<input type='hidden' name='"+index+"' value='"+$('[name="'+index+'"]').val()+"'>"
// 		}else{
// 			let res = ''
// 			if (typeof(parameter[index]) == 'string') {
// 				res = parameter[index]
// 			}else{
// 				res = JSON.stringify(parameter[index])
// 			}

// 			html += "<input type='hidden' name='"+index+"' value='"+res+"'>"
// 		}
// 	})

// 	$('#add-export-input').html(html)
// })

$('#dataTable_wrapper').on('click', '.multi-delete', function () {
	let fhead = $($('#dataTable').find('tr').get(0)).find('th:first-child')
	$(this).toggleClass('active')
	showSelectRow(fhead, $(this).hasClass('active'))
})

$('#dataTable').on('click', '[name="deleteall"]', function () {
	if ($(this).is(':checked')) {
		$('[name="deleteselect[]"]').prop('checked', true)
	} else {
		$('[name="deleteselect[]"]').prop('checked', false)
	}
})

$('.filter-select2').each(function () {
	if ($(this).hasClass('select2ajax')) {
		let url = $(this).data('route')
		let label = $(this).data('label')
		$(this).select2({
			// minimumInputLength: 1,
			ajax: {
				url: url,
				dataType: 'json',
				delay: 100,
				data: function (params) {
					let query = {
						search: params.term,
					}
					return query;
				},
				processResults: function (data) {
					let newVal = [
						{ id: 'all', text: 'Semua ' + label },
						...data
					]
					return {
						results: newVal
					};
				}
			}
		});
	} else {
		$(this).select2()
	}

})

$('.btn-reset').click(function () {
	$('.element-filter').find('input,select').each(function (i, v) {
		if ($(v).prop("tagName") == 'SELECT') {
			let label = $(v).data('label')
			$(v).val('all').change()
		} else {
			$(v).val('')
		}
	})

	paramExportExcel()
	resDataTable.ajax.reload(resetSelectRow())
})


// $('.filter-select2').on('select2:select', function(){
// 	let self = $(this)
// 	if ($(this).hasClass('select2ajax')) {
// 		let url = self.data('route')
// 		let param = self.data('param')
// 		console.log(url)
// 		$.ajax({
// 			url:url+'?'+self.attr('name')+'='+self.val(),
// 			method:'post',
// 			success:function(res){
// 				res.unshift({id:'all',text:'Semua '+$('[name="'+param+'"]').data('label')})
// 				$('[name="'+param+'"]').html('').select2({data:res})
// 			}
// 		})
// 	}
// })

// $('#modal-import').on('submit','.save-import', function(e){
// 	e.preventDefault()
// 	let self = $(this)
// 	let sub = self.find('[type="submit"]') 
// 	sub.next().attr('disabled',true)
// 	sub.attr('disabled',true).append(' <i class="icon-spinner2 spinner"></i>')
// 	$.ajax({
// 		url: self.prop('action'),
// 		method: 'post',
// 		data: new FormData(this),
// 		processData: false,
// 		contentType: false,
// 		xhr: function(){
// 			var xhr = $.ajaxSettings.xhr();
// 			$('.progress').show();
// 			var line = $('.progress-bar')
// 			xhr.onprogress = function(e){
// 				responseLen = e.currentTarget.responseText.split(',');
// 				let number = responseLen[responseLen.length-1];
// 				line.css('width',number+'%')
// 				line.text(number+' %')	
// 			};
// 			return xhr;
// 		},
// 		success:function(res){
// 			$('.progress').hide();
// 			var line = $('.progress-bar')
// 			line.css('width','0%')
// 			line.text('0%')

// 			let temp = res.split(',')
// 			if (temp[temp.length-1] == 100) {
// 				$('#modal-import').modal('hide')
// 				$('#modal-import').find('[type=file]').val('')
// 				resDataTable.ajax.reload(resetSelectRow())
// 				toastr.success('Import Success')
// 			}else{
// 				toastr.error('Import Failed')
// 			}

// 			sub.next().attr('disabled',false)
// 			sub.attr('disabled',false).find('i').remove()
// 		},
// 		error: function(jqXHR, textStatus, errorThrown) {
// 			$('.progress').hide();
// 			var line = $('.progress-bar')
// 			line.css('width','0%')
// 			line.text('0%')

// 			toastr.error(JSON.stringify(textStatus))

// 			sub.next().attr('disabled',false)
// 			sub.attr('disabled',false).find('i').remove()
// 		}
// 	})
// })

// $('.daterange-basic').daterangepicker({
// 	applyClass: 'bg-slate-600',
// 	cancelClass: 'btn-default',
// 	opens: "left",
// });

// $('#modal-export').on('click','[name="filter_date_export"]', function(){
// 	if ($(this).val() == 'range') {
// 		$('#modal-export').find('.filter_date').show()	
// 	}else{
// 		$('#modal-export').find('.filter_date').hide()	
// 	}
// })

function resetSelectRow() {
	let fhead = $($('#dataTable').find('tr').get(0)).find('th:first-child')
	$('.multi-delete').removeClass('active')
	showSelectRow(fhead, false)
}

function showSelectRow(fhead, status) {
	if (status) {
		fhead.before('<th style="width:50px;"><input type="checkbox" name="deleteall"></th>')
		$('#dataTable').find('tbody tr').each(function (i, v) {
			let fullValue = $(v).find('td:last-child a.delete-data').prop('href').split('/')
			$(v).find('td:first-child').before('<td><input type="checkbox" name="deleteselect[]" value="' + fullValue[fullValue.length - 1] + '"></td>')
		})

		$('.multi-delete').text('Batal Pilih')

		$('.btn-select').after(
			'<div style="float:left" class="action-select"><a href="' + multiDeleteUrl + '" class="btn btn-danger select-delete" style="margin-left:10px;" data-url="">Hapus</a></div>'
			// +'<div style="float:left" class="action-select"><a href="javascript:void(0)" class="btn btn-success" style="margin-left:10px;">Duplikat</a></div>'
		)
	} else {
		$('[name="deleteall"],[name="deleteselect[]"]').parent('td,th').remove()
		$('.multi-delete').text('Pilih Data')

		$('.action-select').remove()
	}
}

paramExportExcel();

function paramExportExcel() {
	let param = '?'
	let emelentInputs = $('.filter-select2,input')

	emelentInputs.each(function (i, v) {
		if ($(v).prop('name')) {
			console.log($(v).prop('name'))
			param += $(v).prop('name') + '=' + $(v).val()
			if (i < (emelentInputs.length - 2)) {
				param += '&'
			}
		}
	})

	let nowUrl = $('.btn-export-excel').prop('href')
	let mainUrl = nowUrl.split("?")[0]

	$('.btn-export-excel').prop('href', mainUrl + param)
}