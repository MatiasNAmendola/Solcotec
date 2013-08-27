addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1);}

$(document).ready(function() {
	

	
$("a#productos").click(function(event) {
$("#novedades").addClass("deco");
$("#novedades").load('productos.html');
$('#titulo').html('<div id="titulodeco">PRODUCTOS</div><div id="subtitulodeco">Importadores de Máquinas Soldadoras, Repuestos, Insumos<br />Artículos de Ferretería Industrial en Chile.</div><div id="fondosub"></div><div id="linearojadeco"></div>');
var focalizar = $("#posicion").position().top;
$('html,body').animate({scrollTop: focalizar}, 1000);
});




$("a#servicio").click(function(event) {

$("#novedades").addClass("deco");
$("#novedades").load('servicio_tecnico.html');
$('#titulo').html('<div id="titulodeco">SERVICIO TÉCNICO</div><div id="subtitulodeco">Laboratorio de Electrónica<br />Reparación Máquinas Soldadoras.</div><div id="fondosub"></div><div id="linearojadeco"></div>');
var focalizar = $("#posicion").position().top;
$('html,body').animate({scrollTop: focalizar}, 1000);

});

$("a#fabricantes").click(function(event) {
$("#novedades").addClass("deco");
$("#novedades").load('fabricantes.html');
$('#titulo').html('<div id="titulodeco">FABRICANTES</div><div id="subtitulodeco">Elaboradores de Termos y Hornos para<br />Secado de Soldaduras con Certificación CESMEC.</div><div id="fondosub"></div><div id="linearojadeco"></div>');




var focalizar = $("#posicion").position().top;
$('html,body').animate({scrollTop: focalizar}, 1000);
});


$("a#contacto").click(function(event) {
$("#novedades").addClass("deco");
$("#novedades").load('contacto.html');
$('#titulo').html('<div id="titulodeco">CONTACTO</div><div id="subtitulodeco">Visitenos en Nuestra Sala de Ventas.</div><div id="fondosub1linea"></div><div id="linearojadeco"></div>');
var focalizar = $("#posicion").position().top;
$('html,body').animate({scrollTop: focalizar}, 1000);
});




	$(document).delegate('.boton_envio','click', function(){
		
		var nombre = $("#nombre").val();
			email = $("#email").val();
			validacion_email = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
			telefono = $("#telefono").val();
			mensaje = $("#mensaje").val();
		
		if (nombre == "") {
		    $("#nombre").focus();
		    return false;
		}else if(email == "" || !validacion_email.test(email)){
		    $("#email").focus();	
		    return false;
		}else if(telefono == ""){
		    $("#telefono").focus();
		    return false;
		}else if(mensaje == ""){
		    $("#mensaje").focus();
		    return false;
		}else{
			$('.ajaxgif').removeClass('hide');
			var datos = 'nombre='+ nombre + 
						'&email=' + email + 
						'&telefono=' + telefono + 
						'&mensaje=' + mensaje;
			$.ajax({
	    		type: "POST",
	    		url: "mail.php",
	    		data: datos,
	    		success: function() {
					$('.ajaxgif').hide();
	      			$('.msg').text('Mensaje enviado!').addClass('msg_ok').animate({ 'left' : '20em' }, 300);	
	    		},
				error: function() {
					$('.ajaxgif').hide();
	      			$('.msg').text('Hubo un error!').addClass('msg_error').animate({ 'left' : '20em' }, 300);					
				}
	   		});
	 		return false;	
		}
	});
});

$(document).delegate('#dual','click',function(){
var focalizar = $("#p_chinas").position().top;
$('html,body').animate({scrollTop: focalizar}, 1000);	
	});

$(document).delegate('#españolas','click',function(){
	var focalizar = $("#p_españolas").position().top;
$('html,body').animate({scrollTop: focalizar}, 1000);
});


$(document).delegate('#italianas','click',function(){
	var focalizar = $("#p_italianas").position().top;
$('html,body').animate({scrollTop: focalizar}, 1000);
});

$(document).delegate('#img_accesorios','click',function(){
	var focalizar = $("#p_accesorios").position().top;
$('html,body').animate({scrollTop: focalizar}, 1000);
});



// fade in #ir_arriba
	$(window).scroll(function () {
			if ($(this).scrollTop() > 450) {
				$('#ir_arriba').fadeIn();
			} else {
				$('#ir_arriba').fadeOut();
			}
		});
		
//#scroll #ir_arriba
$(document).delegate('#ir_arriba','click',function()
      {
            $('html,body').animate({scrollTop:'0px'}, 1000	);return false;
      }
	  
	  
	  
);