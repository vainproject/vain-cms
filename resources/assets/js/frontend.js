// parallax header
$('#cover-image').css("background-position", "50% 50%");
$(window).scroll(function() {
	var scroll = $(window).scrollTop(),
	slowScroll = scroll/4,
	slowBg = 50 - slowScroll;
	if(slowBg < -125){slowBg = -125};
	$('#cover-image').css("background-position", "50% " + slowBg + "%");
});

var images = ['image-bg', 'image-bg2', 'image-bg3'];
var image = images[Math.floor(Math.random() * images.length)];
$('#cover-image').addClass(image);

$(document).ready(function() {
	
	/* off canvas menu ======================================= */
	$('.menu-link, .close-menu').on('click', function(){
		$('#wrap').toggleClass('menu-open');
		return false;
	});

	$('.submenu a').click(function(){
		$(this).parent().toggleClass('submenu-open');
		//return false;
	});

	/* wow ======================================= */
	new WOW().init({
		offset: 20 
	});

	/* Bootstrap Affix ======================================= */		
	$('#modal-bar').affix({
		offset: {
			top: 10,
		}
	});
});