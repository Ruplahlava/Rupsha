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
    $.fn.editable.defaults.emptytext = 'Empty description';  
    $.fn.editable.defaults.emptyclass = 'text-muted';  
    $('#previews').editable({
        selector: '.xeditable'
    });
    
});