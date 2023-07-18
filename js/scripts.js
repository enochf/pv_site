// ----------------------------------------------------------- SLIDE UP DOWN -- //
function show(id) {
	$("#" + id).slideDown('fast');
}
function hide(id) {
	$("#" + id).slideUp('fast');
}
// ----------------------------------------------------------- SCROLL WINDOW -- //
function scrollWin(id){
	$('html, body').animate({
		scrollTop: $("#" + id).offset().top
	}, 500);
}
// function showTip() {
	// $('.hastip').tooltipsy({
		// className: 'bubbletooltip_tip',
		// offset: [10, 0],
		// show: function (e, $el) {
			// $el.fadeIn(100);
		// },
		// hide: function (e, $el) {
			// $el.fadeOut(300);
		// }
	// });
// }
// ----------------------------------------------------------- SHOW HIDE TOOL TIPS -- //
function showTip(id) {
	$("#" + id).fadeIn('fast');
}
function hideTip(id) {
	t = setTimeout(function(){ 
		$("#" + id).fadeOut('fast');
	}, 200);
}
// ----------------------------------------------------------- VALIDATE INPUT FIELDS -- //
var cur;
function getCur() {
	cur = $(this).val();
	alert(cur);
}
function validate(id,type,n1,n2) {
	if (type == 'pct') {
		console.log('n1: ' + n1 + ', n2: ' + n2);
	}
}

