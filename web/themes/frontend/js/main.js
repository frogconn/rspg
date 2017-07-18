var css_id = setTimeout(changeBackground,2000);
function changeBackground(){
	clearTimeout(css_id);
	$(".main_container").css("background-color","#CCC");	
}