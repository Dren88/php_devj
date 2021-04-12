$(document).keyup(function(e) {
	let arr = [37, 38, 39, 40];
	if($.inArray( e.keyCode, arr )){
		alert(e.key);
	}
});