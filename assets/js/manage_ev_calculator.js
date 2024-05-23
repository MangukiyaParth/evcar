jQuery(function () {
    $("[type='range']").on('input', function(){
        var range_selector_wrap = $(this).parents('.range_selector_wrap');
        var val = $(this).val();
        range_selector_wrap.find('.value').html(val);
    });
});
