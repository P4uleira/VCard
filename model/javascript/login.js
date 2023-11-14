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
    var temErro = false;

    // validação Nome
    if($("#nome").val() == ""){
        $("#mensagemNome").text("Preencha o nome.");
        $("#mensagemNome").css("display", "block");
        temErro = true;
    }else {
        $("#mensagemNome").css("display", "none");
        temErro = false;
    }

    // validação Número de Telefone
    var regex = /^\(\d{2}\) \d{5}-\d{4}$/;
    if($("#telNumero").val() == ""){
        $("#mensagemNumero").text("Preencha o número de telefone.");
        $("#mensagemNumero").css("display", "block");
        temErro = true;
    }else if (!regex.test($("#telNumero").val())){
        $("#mensagemNumero").text("Número inválido.");
        $("#mensagemNumero").css("display", "block");
        temErro = true;
    }else {
        $("#mensagemNumero").css("display", "none");
        temErro = false;
    }


    // validação Usuario
    var userNickname = $("#nickname").val();
    $.ajax({
        type: "POST",
        url: "../model/validaLogin.php",
        data: { validaNick: userNickname },
        dataType: 'JSON',
        success: function(response) {
            if (response.encontrou === "existe") {
                let nicknameSpan = document.getElementById("mensagemUsuario");
                nicknameSpan.innerText = "O nome de Usuário ja está em uso! Utilize Outro.";
                nicknameSpan.style.display = "block";
            } else {
                nicknameSpan.style.display = "none";
                if (temErro != true) {
                    $('#criaLogin')[0].submit(); // Envie o formulário se o nome de usuário estiver disponível
                }
            }
        }
    });
});