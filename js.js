$(document).ready(function(){
    // $("#escrever").click(function(){
    $("#destinatario").keyup(checar_campos);
    $("#assunto").keyup(checar_campos);
    $("#mensagem").keyup(checar_campos);
    
});

function checar_campos(){
    var destinatario = $("#destinatario").val();
    var assunto      = $("#assunto").val();
    var mensagem     = $("#mensagem").val();

    if(destinatario == ""){
        $("#destinatarioHelp").html("<p>Este campo é obrigatório</p>").css('color',"red");
        $("#btn-enviar-email").prop("disabled", true);
    }
    else if(assunto == ""){
        $("#assuntoHelp").html("<p>Este campo é obrigatório</p>").css('color','red');
        $("#btn-enviar-email").prop("disabled", true);
    }
    else if(mensagem == "" ){
        $("#mensagemHelp").html("<p>Este campo é obrigatório</p>").css('color','red');
        $("#btn-enviar-email").prop("disabled", true);
    }
    else{
        $("#btn-enviar-email").prop("disabled", false);
    }
}