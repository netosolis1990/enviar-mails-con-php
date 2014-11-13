$(document).ready(function() {
	//Parte para validar los campos del formulario cuando lo enviamos
	fn = $('#form_email');
    fn.bootstrapValidator({
        message: 'El valor no es valido.',
        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
        fields: {
                nombre: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                }
                        }
                },
                asunto: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                }
                        }
                },
                msg: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                }
                        }
                },
                email: {
                	    validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                },
                                emailAddress:{
                                        message: 'El correo no es valido.'
                                }
                        }
                }
                
        },
        //cuando el formulario se lleno correctamente y lo enviamos nos dirijira a esta funcion
        submitHandler: function(validator, form, submitButton) {
            //mediante AJAX enviaremos el formulario serilizado al servidor por el metodo post
			$.post('servidor/servidor.php',fn.serialize(), function(data) {
            	//tomaremos la respuesta del servidor y mostraremos los datos correspondiente
            	//data es la respuesta, regresara 2 parametros exito y msg
            	if(data.exito){
            		nota('success',data.msg);
            		fn[0].reset();
            	}	
            	else{
            		nota('error',data.msg);
            	}
            });
        }
    });

});

//funcion para enviar notificaciones al usuario la libreria la descargas de http://ned.im/noty/
function nota(op,msg,time){
    if(time == undefined)time = 5000;
    var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'top'});
}