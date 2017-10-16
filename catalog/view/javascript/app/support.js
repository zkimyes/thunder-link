$(function() {
    var $searchInput = $("#support_search"),
        $searchBtn = $('#support_search_btn'),
        $loadingBar = $('#loading');

    $searchBtn.on('click', function search() {
        if ($searchInput.val() != '') {
            $loadingBar.show();
            location.href = searchUrl + '&keyword=' + decodeURI($searchInput.val());
        }

    });

    $(window).on('keydown',function(){
        var e = event || window.event;
        if(e.keyCode && e.keyCode == 13 && activeWindow=='support'){
            if ($searchInput.val() != '') {
                $loadingBar.show();
                location.href = searchUrl + '&keyword=' + decodeURI($searchInput.val());
            }
        }
    })

})