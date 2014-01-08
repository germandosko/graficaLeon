$(document).ready(function(){
	efectosIndex();
});

//FUNCION EFECTO MARCAS
function efectosIndex(){		
}

//FUNCION  LINK SOLICITAR FACTURA	
function efectosIndex(){
	var stateMouseEnter1 = true;
	var stateMouseLeave1 = true;	
	$("#effect1").mouseenter(function(){
		if (stateMouseEnter1){
			stateMouseEnter1 = false;
			$(this).animate({height: "100"}, 1000, 'easeOutBounce');
			stateMouseLeave1 = true;
		} 
	});
	$("#effect1").mouseleave(function(){
		if(stateMouseLeave1){
			stateMouseLeave1 = false;
			$(this).animate({height: "50"}, 500, 'easeOutBounce');
			$("#effect1").promise().done(function() {
				stateMouseEnter1 = true;				
			});
		} 
	});
	
	var stateMouseEnter2 = true;
	var stateMouseLeave2 = true;	
	$("#effect2").mouseenter(function(){
		if (stateMouseEnter2){
			stateMouseEnter2 = false;
			$(this).animate({height: "100"}, 1000, 'easeOutBounce');
			stateMouseLeave2 = true;
		} 
	});
	$("#effect2").mouseleave(function(){
		if(stateMouseLeave2){
			stateMouseLeave2 = false;
			$(this).animate({height: "50"}, 500, 'easeOutBounce');
			$("#effect2").promise().done(function() {
				stateMouseEnter2 = true;				
			});
		} 
	});
	
	var stateMouseEnter3 = true;
	var stateMouseLeave3 = true;	
	$("#effect3").mouseenter(function(){
		if (stateMouseEnter3){
			stateMouseEnter3 = false;
			$(this).animate({height: "100"}, 1000, 'easeOutBounce');
			stateMouseLeave3 = true;
		} 
	});
	$("#effect3").mouseleave(function(){
		if(stateMouseLeave3){
			stateMouseLeave3 = false;
			$(this).animate({height: "50"}, 500, 'easeOutBounce');
			$("#effect3").promise().done(function() {
				stateMouseEnter3 = true;				
			});
		} 
	});
}
