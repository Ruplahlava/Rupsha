$(function () {
    // clipboard
    var client = new ZeroClipboard($(".btn-copy"));
    client.on("ready", function (readyEvent) {
        client.on("aftercopy", function (event) {
            $('.btn-copy').popover('show');
        });
    });
    // bootstrap switch
    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    $("[name='confirm-switch']").bootstrapSwitch();
    $("[name='confirm-switch']").on('switchChange.bootstrapSwitch', function (event, state) {
        $('.btn-delete').toggleClass("disabled");
    });
    // editables 
    $.fn.editable.defaults.mode = 'popup';
    $.fn.editable.defaults.emptytext = 'Empty';
    $.fn.editable.defaults.emptyclass = 'text-muted';
    $('#previews').editable({
        selector: '.xeditable',
        emptytext: "Empty description"
    });
    $('.header-xeditable').editable({
        validate: function (value) {
            if ($.trim(value) == '')
                return 'This field is required';
        },
        placement: 'right'
    });
    $('.date-xeditable').editable({
        format: 'yyyy-mm-dd',    
        viewformat: 'dd.mm.yyyy',  
        placement: 'right',
        datepicker: {
                weekStart: 1
           }
        });
    $('.location-xeditable').editable({
        placement: 'right'
    });
    $('.text-xeditable').editable({
        placement: 'right'
    });

});