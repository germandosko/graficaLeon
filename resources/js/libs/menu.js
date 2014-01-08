
(function(){
	$(function(){
		linkMouseOver = true;
		linkMouseOver2 = true;
		linkMouseOver3 = true;
		linkMouseOver4 = true;
		linkMouseOver5 = true;
		linkMouseOver6 = true;

		menuEffect(); 
	});

	function menuEffect(){
		$("#link_tarjetas").mouseover(function(){
			if(linkMouseOver){
				linkMouseOver = false;
				$('#submenu_tarjetas').slideDown(500, 'easeOutBounce');
				linkMouseLeave = true;
			}
		});
		$("#link_tarjetas").click(function(){
			$('#submenu_tarjetas').slideDown(500, 'easeOutBounce');
			linkMouseLeave = true;
		});
		$("#link_tarjetas").mouseleave(function(){
			if (linkMouseLeave){
				linkMouseLeave = false;
				$("#submenu_tarjetas").css('display', 'none');
				$("#submenu_tarjetas").promise().done(function() {
					linkMouseOver = true;				
				});
			}
		});
		$("#link_personales").mouseover(function(){
			if(linkMouseOver){
				linkMouseOver = false;
				$('#submenu_personales').fadeIn(500, 'easeOutBounce');
				linkMouseLeave = true;
			}
		});
		$("#link_personales").click(function(){
			$('#submenu_personales').fadeIn(500, 'easeOutBounce');
			linkMouseLeave = true;
		});
		$("#link_personales").mouseleave(function(){
			if (linkMouseLeave){
				linkMouseLeave = false;
				$("#submenu_personales").css('display', 'none');
				$("#submenu_personales").promise().done(function() {
					linkMouseOver = true;				
				});
			}
		});
		$("#link_folletos").mouseover(function(){
			if(linkMouseOver){
				linkMouseOver = false;
				$('#submenu_folletos').slideDown(500, 'easeOutBounce');
				linkMouseLeave = true;
			}
		});
		$("#link_folletos").click(function(){
			$('#submenu_folletos').slideDown(500, 'easeOutBounce');
			linkMouseLeave = true;
		});
		$("#link_folletos").mouseleave(function(){
			if (linkMouseLeave){
				linkMouseLeave = false;
				$("#submenu_folletos").css('display', 'none');
				$("#submenu_folletos").promise().done(function() {
					linkMouseOver = true;				
				});
			}
		});
		$("#link_otros").mouseover(function(){
			if(linkMouseOver){
				linkMouseOver = false;
				$('#submenu_otros').slideDown(500, 'easeOutBounce');
				linkMouseLeave = true;
			}
		});
		$("#link_otros").click(function(){
			$('#submenu_otros').slideDown(500, 'easeOutBounce');
			linkMouseLeave = true;
		});
		$("#link_otros").mouseleave(function(){
			if (linkMouseLeave){
				linkMouseLeave = false;
				$("#submenu_otros").css('display', 'none');
				$("#submenu_otros").promise().done(function() {
					linkMouseOver = true;				
				});
			}
		});
		$("#link_talonarios").mouseover(function(){
			if(linkMouseOver){
				linkMouseOver = false;
				$('#submenu_talonarios').slideDown(500, 'easeOutBounce');
				linkMouseLeave = true;
			}
		});
		$("#link_talonarios").click(function(){
			$('#submenu_talonarios').slideDown(500, 'easeOutBounce');
			linkMouseLeave = true;
		});
		$("#link_talonarios").mouseleave(function(){
			if (linkMouseLeave){
				linkMouseLeave = false;
				$("#submenu_talonarios").css('display', 'none');
				$("#submenu_talonarios").promise().done(function() {
					linkMouseOver = true;				
				});
			}
		});
		$("#link_disenos").mouseover(function(){
			if(linkMouseOver){
				linkMouseOver = false;
				$('#submenu_disenos').slideDown(500, 'easeOutBounce');
				linkMouseLeave = true;
			}
		});
		$("#link_disenos").click(function(){
			$('#submenu_disenos').slideDown(500, 'easeOutBounce');
			linkMouseLeave = true;
		});
		$("#link_disenos").mouseleave(function(){
			if (linkMouseLeave){
				linkMouseLeave = false;
				$("#submenu_disenos").css('display', 'none');
				$("#submenu_disenos").promise().done(function() {
					linkMouseOver = true;				
				});
			}
		});
	}
}());