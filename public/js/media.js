delete page, setTargetElement, setTag, urlGet, lastPage, datas;
var page = 0
var setTargetElement = ''
var setTag = ''
var urlGet = ''
var lastPage = 0
var datas = []

$('body').on('click', '.add-media-container', function () {
	urlGet = $(this).data('url')
	$('#modal-media-library').modal('show')
	setTargetElement = $(this)
	$(this).parents('.media-container').find('input').val()
	getMedia(1);
	page = 1
	setTag = $(this).data('tag')
})

$('body').on('click', '.not-img .remove-media-container', function () {
	let set = $(this).parents('.parent-media')
	set.find('input').val('')
	set.find('img').prop('src', '')
	set.find('.add-media-container').show()
	set.find('.view-media-container').hide()
	$(this).hide()
})

$('#modal-media-library').on('hidden.bs.modal', function () {
	$('[name="select_media[]"]:checked').prop("checked", false);
	$('#modal-media-library').find('.select-row').removeClass('border-select')
	setTargetElement = ''
})

$('#save-media-container').click(function () {
	let val = [];
	let html = ''
	let id = []
	let set = ''
	if (setTargetElement) set = setTargetElement.parents('.parent-media')

	$('[name="select_media[]"]:checked').each(function (i) {
		let data = datas[parseInt($(this).val())];
		if (!set) {
			console.log(data)
			let editor = CKEDITOR.instances['content'];
			if (data.type == 'image') {
				let splitImage = data.img.split('-mini')
				editor.insertHtml('<p><img  src="' + splitImage[0] + splitImage[1] + '" alt="' + data.name + '" /></p><p></p>');
			} else if (data.type === 'application') {
				editor.insertHtml('<a href="' + data.link + '" target="blank" >' + data.name + '<a/>')
			} else if (data.type == 'audio') {
				editor.insertHtml('<p><audio src="' + data.link + '" controls></audio></p><p></p>')
			} else if (data.type === 'video') {
				editor.insertHtml('<p><video src="' + data.link + '" controls></video></p><p></p>')
			}
		} else {
			if (set.hasClass('media-list')) {
				html += '<li>' +
					'<input type="checkbox" name="' + setTag + '[]" checked value="' + data.id + '" style="display:none;">' +
					'<a href="' + data.link + '" target="_blank">' + data.name + '</a>' +
					'<span class="pull-right" style="font-size: 15px;">	' +
					'<a href="javascript:void(0)" class="remove-list"><i class="lnr lnr-trash"></i></a>	' +
					'</span> ' +
					'</li>'

			} else if (set.hasClass('team-list')) {
				html += '<li>' +
					'<input type="checkbox" name="' + setTag + '[]" checked value="' + data.id + '" style="display:none;">' +
					'<img src="' + data.img + '" width="30" class="img-circle">' +
					'<span style="padding-left: 10px;font-weight: bold;">' + data.name + '</span>' +
					'<span class="pull-right" style="padding-top: 5px;font-size: 15px;">' +
					'<a href="javascript:void(0)" class="remove-list"><i class="lnr lnr-trash"></i></a>' +
					'</span>' +
					'</li>'

			} else if (set.hasClass('media-container')) {
				html += '<span style="border:1px solid white;" class="remove-media-container"><input name="attr[' + setTag + '][]" value="' + data.id + '" style="display:none"><img src="' + data.img + '" width="150" style="float:left;"></span>'

			} else {

				id.push($(this).val())
				if (set.find('input').prop('name') == 'media_id') {
					set.find('input').val(data.id)
					set.find('img').prop('src', data.img)
				}

				if (set.find('input').has('.attr-id')) {
					set.find('.attr-id').val(data.id)
					set.find('.attr-name').val(data.name)
					set.find('img').prop('src', data.img)
					set.find('.remove-media-container').show()
					set.find('.view-media-container').show()
					set.find('.add-media-container').hide()
				}
			}
		}
	});

	set ? set.find('.media-target').append(html) : ''
	$('#modal-media-library').modal('hide')
})

$('.btn-upload-media').click(function () {
	$('#modal-media-library [name="media[]"]').click()
})

$('#modal-media-library').on('change', ':checkbox', function () {
	if (this.checked) {
		$(this).parents('.select-row').addClass('border-select')
	} else {
		$(this).parents('.select-row').removeClass('border-select')
	}
})

$('#modal-media-library [name="media[]"]').change(function () {
	$('.save-media-ajax').submit()
})

$('#modal-media-library .modal-body').scroll(function (event) {
	if ($(this)[0].scrollHeight - $(this).scrollTop() == $(this).outerHeight()) {
		page++

		if (parseInt(page) <= lastPage) {
			getMedia(page);
		}
	}
});

$('#modal-media-library').on('submit', '.save-media-ajax', function (e) {
	e.preventDefault()
	let self = $(this)
	let formData = new FormData(this)
	$.ajax({
		url: self.prop('action'),
		method: 'post',
		data: formData,
		processData: false,
		contentType: false,
		xhr: function () {
			var xhr = new window.XMLHttpRequest();
			$('.progress').show();
			var line = $('.progress-bar')
			xhr.upload.addEventListener("progress", function (evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					line.css('width', Math.round(percentComplete * 100) + '%')
					line.text(Math.round(percentComplete * 100) + ' %')
				}
			}, false);
			return xhr;
		},
		success: function (res) {
			$('.progress').hide();
			var line = $('.progress-bar')
			line.css('width', '0%')
			line.text('0%')
			if (res.status == 'success') {
				lastPage = res.lastPage
				page = 1
				datas = res.datas
				$('#modal-media-library .row').html(res.html)
				toastr.success(res.message)
			} else {
				toastr.error(res.message)
			}
		},
		error: function (error) {
			$('.progress').hide();
			var line = $('.progress-bar')
			line.css('width', '0%')
			line.text('0%')
			toastr.error(error.hasOwnProperty('responseJSON') ? error.responseJSON.message : error.statusText)
		}
	})
})

$('.panel').on('click', '.remove-list', function () {
	$(this).parents('li').remove()
})

$('.media-container').on('click', '.remove-media-container', function () {
	$(this).remove();
})

function getMedia(page) {
	$.ajax({
		url: urlGet,
		method: 'post',
		data: {
			'page': page
		},
		success: function (res) {
			if (res.status == 'success') {
				lastPage = res.lastPage
				if (page == 1) {
					datas = res.datas
					$('#modal-media-library .row').html(res.html)
				} else {
					datas = { ...datas, ...res.datas }
					$('#modal-media-library .row').append(res.html)
				}
			} else {
				toastr.error(res.message)
			}
		}, error: function (error) {
			toastr.error(error.hasOwnProperty('responseJSON') ? error.responseJSON.message : error.statusText)
		}
	})
}