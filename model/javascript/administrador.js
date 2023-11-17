$(document).ready(function(){    
    $("#usuariosS").change(function(){
        var tipousuario = $("#tipoUsuario").text();
        var usuarioSelecionado = $(this).val();       

        window.location.href = "../views/administrador.php?edit&user=" + tipousuario + "&userselect=" + usuarioSelecionado;      
      
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