$('textarea.editor').each(function () {
    CKEDITOR.replace($(this).attr('id'));
});

console.log(idExist)
if (idExist == '0') {
    $('body').on('input', '[name="title"]', function () {
        let stringTitle = $(this).val().toLowerCase().trim()
        let reSpace = stringTitle.replaceAll(/\s+/g, '-')
        let reSym = reSpace.replaceAll(/[^a-zA-Z0-9_-]/g, '')
        $('[name="slug"]').val(reSym)
    })
}

$(".sortable-exclude").sortable({
    connectWith: '.custom-sortable',
    items: 'tr',
    helper: 'original',
    cursor: 'move',
    handle: '[data-action=move]',
    revert: 100,
    containment: '.page-container',
    forceHelperSize: true,
    placeholder: 'sortable-placeholder',
    forcePlaceholderSize: true,
    tolerance: 'pointer',
    start: function (e, ui) {
        ui.placeholder.height(ui.item.outerHeight());
    }, update: function (e, ui) {
        $('.sortable-exclude').find('tr').each(function (i, v) {
            $(v).find('.number').text(i + 1)
            let data = $(v).find('input').val()
            let decode = JSON.parse(data)
            decode.sequence = i + 1;
            $(v).find('input').val(JSON.stringify(decode))
        })
    }
});

$(".media-target").sortable({
    connectWith: '.custom-sortable',
    items: '.item-media',
    helper: 'original',
    cursor: 'move',
    handle: '[data-action=move]',
    revert: 100,
    containment: '.page-container',
    forceHelperSize: true,
    placeholder: 'sortable-placeholder',
    forcePlaceholderSize: true,
    tolerance: 'pointer',
    start: function (e, ui) {
        ui.placeholder.height(ui.item.outerHeight());
    }, update: function (e, ui) {
        $('.media-target').find('.item-media').each(function (i, v) {
            $(v).find('.label').text(i + 1)
            let data = $(v).find('input').val()
            let decode = JSON.parse(data)
            decode.sequence = i + 1;
            $(v).find('input').val(JSON.stringify(decode))
        })
    }
});