$(document).ready(function(){    
    $("#usuariosS").change(function(){
        var tipousuario = $("#tipoUsuario").text();
        var usuarioSelecionado = $(this).val();       

        window.location.href = "../views/administrador.php?edit&user=" + tipousuario + "&userselect=" + usuarioSelecionado;      
      
    });
  });



function organizacaoSelecionada() {
    var selectUser = $("#organizacao");
    var userSelected = selectUser.val();    
    
    window.location.href = "../views/administrador.php?esc&user=" + userSelected;
}