jQuery(document).ready(function ($) {
    let time = new Date().getTime();
    $(document.body).bind("mousemove keypress", function(e) {
        time = new Date().getTime();
    });
    function refresh() {
        if(new Date().getTime() - time >= bj_object.seconds)
            window.location.reload(true);
        else
            setTimeout(refresh, 10000);
    }
    setTimeout(refresh, 10000);
});