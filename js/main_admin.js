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
        $(this).closest('.switch-wrap').children().first().children('.btn-delete').toggleClass("disabled");
        $(this).closest('.switch-wrap').children('.btn-delete').toggleClass("disabled");
    });
    $("[name='mainpage-switch']").bootstrapSwitch();
    $("[name='mainpage-switch']").on('switchChange.bootstrapSwitch', function (event, state) {
        $('.mainpage').find('input,textarea').prop('disabled', function (idx, oldProp) {
            return !oldProp;
        });
        $('.submit-mainpage').toggleClass('disabled');
        var address = $(location).attr('href').replace('/mainpage','/mainpage_switch');
        $.post(address);
    });
    $("[name='hidden-switch']").bootstrapSwitch();
    $("[name='hidden-switch']").on('switchChange.bootstrapSwitch', function (event, state) {
        var address = $(location).attr('href').replace('/upload/','/hidden_switch/');
        console.log(address);
        $.post(address);
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
//datatables
$(document).ready( function () {
    $('#album_overview').DataTable({
    serverSide: true,
    ajax: {
        url: $(location).attr('href').replace('/upload','/album_data'),
        type: 'POST'
    }
} );
} );
});