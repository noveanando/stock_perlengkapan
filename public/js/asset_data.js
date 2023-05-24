$('[name="category_id"]').select2({
    ajax: {
        url: autoCategory,
        dataType: 'json',
        delay: 100,
        data: function (params) {
            return {
                search: params.term
            }
        },
        processResults: function (data) {
            return {
                results: data
            };
        }
    }
});

$('[name="location_id"]').select2({
    ajax: {
        url: autoLocation,
        dataType: 'json',
        delay: 100,
        data: function (params) {
            return {
                search: params.term,
                parent_id: null
            }
        },
        processResults: function (data) {
            let newData = [{
                id: '',
                text: 'Tidak Ada'
            }, ...data];
            return {
                results: newData
            };
        }
    }
}).on('select2:select', function (e) {
    let dataselect = e.params.data
    $('.child_location').css('display', dataselect.id != '' ? 'block' : 'none')
    $('[name="child_location_id"]').val('').change()
});

$('[name="child_location_id"]').select2({
    ajax: {
        url: autoLocation,
        dataType: 'json',
        delay: 100,
        data: function (params) {
            return {
                search: params.term,
                parent_id: $('[name="location_id"]').val()
            }
        },
        processResults: function (data) {
            let newData = [{
                id: '',
                text: 'Tidak Ada'
            }, ...data];
            return {
                results: newData
            };
        }
    }
});

if (!$('[name="company_id"]').val()) {
    companyId = localStorage.getItem('company')
    $('[name="company_id"]').val(companyId)
}

$('.btn-history').click(function () {
    let type = $(this).data('type')
    $('#modal-' + type + '-history').modal('show')
})

$('.btn-edit').click(function () {
    $(this).hide()
    $('.content-editor').show()
})

$('.btn-cancel').click(function () {
    $('.content-editor').hide()
    $('.btn-edit').show()
})

$('[data-popup="lightbox"]').fancybox({
    padding: 0
});