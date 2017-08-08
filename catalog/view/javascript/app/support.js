$(function(){
    var $searchInput = $("#support_search"),
        $searchBtn = $('#support_search_btn');
    
    $searchBtn.on('click',function search(){
        location.href=searchUrl+'&search='+decodeURI($searchInput.val())
    })
    
})