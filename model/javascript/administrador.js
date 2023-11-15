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

function removeUsuario(usuario) {
    $.post("../model/exclui.php", { nome: usuario }, function(data) {        
        location.reload(true);
    });
}