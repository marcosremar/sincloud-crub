$('body').on('click', '[data-toggle="modal"]', function(){
    var $this = $(this);
    $.get($(this).attr("href"), function(data, status){

        var $html = $(data).filter('.modal-header').html();
        $($this.data("target")+' .modal-header').html($html);

        $html = $(data).filter('.modal-body').html();
        $($this.data("target")+' .modal-body').html($html);

        $html = $(data).filter('.modal-footer').html();
        $($this.data("target")+' .modal-footer').html($html);

    });
});
$(function(){
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });
});
