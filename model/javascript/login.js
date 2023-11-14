$('#telNumero').on('input', function() {
    var inputValue = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
    var formattedValue = formatarTelefone(inputValue);
    $(this).val(formattedValue);
  });

  // Formata o número de telefone
  function formatarTelefone(value) {
    var formattedValue = '';

    for (var i = 0; i < value.length; i++) {
      if (i === 0) {
        formattedValue += '(';
      } else if (i === 2) {
        formattedValue += ') ';
      } else if (i === 7) {
        formattedValue += '-';
      }
      formattedValue += value[i];
    }

    return formattedValue;
}

$('#criaLogin').submit(function(event) {
    event.preventDefault();

    $("#mensagemNome").css("display", "none");
    $("#mensagemNumero").css("display", "none");
    $("#mensagemEmail").css("display", "none");
    var temErro = 0;

    // validação Nome
    if($("#nome").val() == ""){
        $("#mensagemNome").text("Preencha o nome.");
        $("#mensagemNome").css("display", "block");
        temErro++;
    }

    // validação Número de Telefone
    var regex = /^\(\d{2}\) \d{5}-\d{4}$/;
    if($("#telNumero").val() == ""){
        $("#mensagemNumero").text("Preencha o número de telefone.");
        $("#mensagemNumero").css("display", "block");
        temErro++;
    }else if (!regex.test($("#telNumero").val())){
        $("#mensagemNumero").text("Número inválido.");
        $("#mensagemNumero").css("display", "block");
        temErro++;
    }

    // Validação Email
    if($("#email").val() == ""){
        $("#mensagemEmail").text("Preencha o campo de email.");
        $("#mensagemEmail").css("display", "block");
        temErro++;        
    }
    
    console.log(temErro);

    // validação Usuario
    var userNickname = $("#nickname").val();
    $.ajax({
        type: "POST",
        url: "../model/validaLogin.php",
        data: { validaNick: userNickname },
        dataType: 'JSON',
        success: function(response) {
            if (response.encontrou === "existe") {             
                $("#mensagemUsuario").text("O nome de Usuário ja está em uso! Utilize Outro.");
                $("#mensagemUsuario").css("display", "block");
            } else {
                $("#mensagemUsuario").css("display", "none");
                if (temErro <= 0) {
                    $('#criaLogin')[0].submit(); // Envie o formulário se o nome de usuário estiver disponível
                }
            }
        }
    });
});