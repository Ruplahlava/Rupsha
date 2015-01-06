$(function () {
    var client = new ZeroClipboard($(".btn-copy"));
    client.on("ready", function (readyEvent) {
        client.on("aftercopy", function (event) {
            $('.btn-copy').popover('show');
        });
    });
});