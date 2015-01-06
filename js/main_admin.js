$(function () {
    var client = new ZeroClipboard($(".btn-copy"));
    client.on("ready", function (readyEvent) {
        client.on("aftercopy", function (event) {
            $('.btn-copy').popover('show');
        });
    });
    $.fn.bootstrapSwitch.defaults.size = 'mini';
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    $("[name='confirm-switch']").bootstrapSwitch();
    $("[name='confirm-switch']").change(function () {
        console.log('arr');
        $('.btn-delete').toggleClass("disabled");
    });
});