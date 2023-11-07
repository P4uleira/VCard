function eventoSelecionado() {
    
    var selectElement = $("#eventos");
    var eventoSelect = selectElement.val();    
    
    window.location.href = "organizador.php?modo=eEvento&idEvento=" + eventoSelect;
}

function removeParticipante(usuarioParticipante) {
    $.post("../model/excluiUsuario.php", { nome: usuarioParticipante }, function(data) {
        alert("Usuario: " + usuarioParticipante + " foi excluído do sistema");
        location.reload(true);
    });
}