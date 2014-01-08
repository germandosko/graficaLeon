
$(document).ready(function(){
	colaEfectosMarcas();
	linkMouseEnter = true;
	linkMouseLeave = true;
	linkInvoiceEffects();
});

//FUNCION EFECTO MARCAS
function colaEfectosMarcas(){		
	$("#imagen_1").fadeOut(2000, function(){
		$(this).fadeIn(2000);
		$("#imagen_2").fadeOut(2000,function(){
			$(this).fadeIn(2000);
			$('#imagen_3').fadeOut(2000,function(){
				$(this).fadeIn(2000);
			});
		});
	});
	$("#marca_1").fadeOut(2000, function(){
		$(this).fadeIn(2000);
		$("#marca_2").fadeOut(2000,function(){
			$(this).fadeIn(2000);
			$('#marca_3').fadeOut(2000,function(){
				$(this).fadeIn(2000, colaEfectosMarcas);
			});
		});
	});
}

//NEW INVOICE REGISTRATION	
function linkInvoiceEffects(){		
	$("#linkInvoice").mouseenter(function(){
		if (linkMouseEnter){
			linkMouseEnter = false;
			$("#linkInvoice span").fadeToggle(1000);
			$(this).animate({width: "250"}, 500, 'easeOutBounce');
			linkMouseLeave = true;
		}
	});
	$("#linkInvoice").mouseleave(function(){
		if (linkMouseLeave){
			$("#linkInvoice span").css('display', 'none');
			linkMouseLeave = false;
			$(this).animate({width: "100"}, 500, 'easeOutBounce');
			$("#linkInvoice").promise().done(function() {
				linkMouseEnter = true;				
			});
		}
	});
}


function showForm(){
	$("form").show(100);
	$("#linkUser a").show(100);
}