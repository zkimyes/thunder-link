$(function() {
    var $searchInput = $("#support_search"),
        $searchBtn = $('#support_search_btn'),
        $loadingBar = $('#loading');

    $searchBtn.on('click', function search() {
        if ($searchInput.val() != '') {
            $loadingBar.show();
            location.href = searchUrl + '&search=' + decodeURI($searchInput.val());
        }

    })

})