$(document).foundation()

$(document).ready(function(){
  $(window).scroll(function(){
  	var scroll = $(window).scrollTop();
	  if (scroll > 200) {
	    $("header.cw-header-wrapper").css("background" , "#00A1AF");
	  }

	  else{
		  $("header.cw-header-wrapper").css("background" , "transparent");
	  }
  })
})
