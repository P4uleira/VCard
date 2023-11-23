$(document).ready(function(){    
    $("#usuariosS").change(function(){
        var tipousuario = $("#tipoUsuario").text();
        var usuarioSelecionado = $(this).val();       

        window.location.href = "../views/administrador.php?edit&user=" + tipousuario + "&userselect=" + usuarioSelecionado;      
      
    });
  });

  $('#formAtualiza').submit(function(event) {
    event.preventDefault();
    var temErro = 0;

    // validação Usuario
    var userNickname = $("#aUser").val();
    
    $.ajax({
        type: "POST",
        url: "../model/validaLogin.php",
        data: { validaNick: userNickname },
        dataType: 'JSON',
        success: function(response) {
            console.log(response)
            if (response.encontrou === "existe") {             
                $("#mensagemUsuario").text("O nome de Usuário ja está em uso! Utilize Outro.");
                $("#mensagemUsuario").css("display", "block");
            } else {
                $("#mensagemUsuario").css("display", "none");
                console.log(temErro)
                if (temErro <= 0) {
                    $('#formAtualiza')[0].submit(); 
                }
            }
        }
    });
}); 

function tipoUsuarioSelecionadoExcluir() {
    var selectUser = $("#tipouserexcluir");
    var userSelected = selectUser.val();    
    
    window.location.href = "../views/administrador.php?esc&user=" + userSelected;
}

function tipoUsuarioSelecionadoEditar() {
    var selectUser = $("#tipousereditar");
    var userSelected = selectUser.val();    
    
    window.location.href = "../views/administrador.php?edit&user=" + userSelected;
}

function editarUsuario(tipousuario, usuario) {
    window.location.href = "../views/administrador.php?edit&user=" + tipousuario + "&userselect=" + usuario;
}

function removeUsuario(usuario) {
    $.post("../model/exclui.php", { nome: usuario }, function(data) {        
        location.reload(true);
    });
}