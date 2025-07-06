$('body').on('click', '.item-add', function (e) {
    var cls = $(this).data('item-class');
    var inputname = $(this).data('input-name');
    $("#new-div-" + cls).append($("." + cls + ':last').clone());

    $("." + cls + ':last').find('input').val('');

    var itemNumber = $("." + cls + ':last .' + cls + '-num');
    var itemNumberCount = $("." + cls + ':last .' + cls + '-num').data('number')
    var num = (parseInt(itemNumberCount) + 1);

    $("." + cls + ':last').find('input').each(function () {
        this.name = this.name.replace(inputname + '[' + (parseInt(itemNumberCount)-1) + ']', inputname + '[' + parseInt(itemNumberCount) + ']');
        // alert(this.name); //just checking if does it change
    });
    $("." + cls + ':last').find('select').each(function () {
        this.name = this.name.replace(inputname + '[' + (parseInt(itemNumberCount)-1) + ']', inputname + '[' + parseInt(itemNumberCount) + ']');
        // alert(this.name); //just checking if does it change
    });

    $("." + cls + ':last').find('textarea').each(function () {
        this.name = this.name.replace(inputname + '[' + (parseInt(itemNumberCount)-1) + ']', inputname + '[' + parseInt(itemNumberCount) + ']');
        // alert(this.name); //just checking if does it change
    });

    itemNumber.attr('data-number', num);
    // itemNumber.html(num);

    $('.date-picker-input').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom",
        rtl: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-right"></i>',
            rightArrow: '<i class="fa fa-angle-left"></i>'
        }
    });
});

$('body').on('click', '.item-remove', function (e) {
    var cls = $(this).data('item-class');
    var inputname = $(this).data('input-name');
    $("." + cls + ':last').remove()
});