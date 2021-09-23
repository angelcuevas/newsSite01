$(document).ready(function(){
    
    (function($) {
        "use strict";

    
    jQuery.validator.addMethod('answercheck', function (value, element) {
        return this.optional(element) || /^\bcat\b$/.test(value)
    }, "type the correct answer -_-");

    // validate contactForm form
    $(function() {
        $('#contactForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                subject: {
                    required: true,
                    minlength: 4
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true,
                    minlength: 20
                }
            },
            messages: {
                name: {
                    required: "Requerido*",
                    minlength: "Muy corto"
                },
                subject: {
                    required: "Requerido*",
                    minlength: "Muy corto"
                },
                email: {
                    required: "Requerido*"
                },
                message: {
                    required: "Requerido*",
                    minlength: "Muy corto"
                }
            },
            submitHandler: function(form) {
                
                //$(form).submit();
                $(form).ajaxSubmit({
                    type:"POST",
                    data: $(form).serialize(),
                    url:"contact_process.php",
                    success: function(data) {
                    
                        
                        if(data == "exito"){
                            $(form).find(':input').val('');
                            $("#cartel_exito").show();
                        }else{
                            $("#cartel_error").show()
                        }

                        //$('#contactForm :input').attr('disabled', 'disabled');
                        // $('#contactForm').fadeTo( "slow", 1, function() {
                        //     $(this).find(':input').attr('disabled', 'disabled');
                        //     $(this).find('label').css('cursor','default');
                        //     $('#success').fadeIn()
                        //     $('.modal').modal('hide');
		                // 	$('#success').modal('show');
                        // })
                    },
                    error: function() {
                        $("#cartel_error").show()
                        $('#contactForm').fadeTo( "slow", 1, function() {
                            $('#error').fadeIn()
                            $('.modal').modal('hide');
		                	$('#error').modal('show');
                        })
                    }
                })
            }
        })


        $('#comentarioForm').validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 5
                },
                texto: {
                    required: true,
                    minlength: 20
                }
            },
            messages: {
                nombre: {
                    required: "Requerido*",
                    minlength: "Muy corto"
                },

                texto: {
                    required: "Requerido*",
                    minlength: "Muy corto"
                }
            },
            submitHandler: function(form) {
                
                
                $(form).ajaxSubmit({
                    type:"POST",
                    data: $(form).serialize(),
                    url:"guardar_comentario.php",
                    success: function(data) {
                        
                        if( !isNaN(data.trim())){
                            $(form).find(':input').val('');
                            $("#cartel_exito").show();

                            $.ajax({url: "comentarios_de_ajax.php", type:"POST", data: {id_noticia: data.trim()}, success: function(result){
                                $("#comentarios_holder").html(result);
                              }});

                        }else{
                            $("#cartel_error").show()
                        }

                    },
                    error: function() {
                        $("#cartel_error").show()
                        $('#contactForm').fadeTo( "slow", 1, function() {
                            $('#error').fadeIn()
                            $('.modal').modal('hide');
		                	$('#error').modal('show');
                        })
                    }
                })
            }
        })

    })
        
 })(jQuery)
})