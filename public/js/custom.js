jQuery(document).ready(function(){

	// Mobile menu
	$('.nav-icon').click(function () {
		$('.mobile_menu').toggleClass('canvas-menu');
		return false;

	});


});

$('.sub-menu ul').hide();
$(".sub-menu a").click(function () {
	$(this).parent(".sub-menu").children("ul").slideToggle("100");
	$(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});


imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
        $("#blah").removeClass('d-none');
    }
};

