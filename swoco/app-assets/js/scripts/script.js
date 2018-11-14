$(document).ready(function() {
//change CAPTCHA on each click or on refreshing page
    $("#reload").click(function() {
        $("img#img").remove();
		var id = Math.random();
        $('<img id="img" src="captch.php?id='+id+'"/>').appendTo("#imgdiv");
		 id ='';
    });
});