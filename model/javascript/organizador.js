function eventoSelecionado() {
    
    var selectElement = $("#eventos");
    var eventoSelect = selectElement.val();    
    
    window.location.href = "organizador.php?modo=eEvento&idEvento=" + eventoSelect;
}

function removeParticipante(usuarioParticipante) {

    var confirmacao = confirm("Tem certeza que deseja excluir este participante?");
    
    if (confirmacao) {
        $.post("../model/exclui.php", { nome: usuarioParticipante }, function(data) {
            alert("Usuario: " + usuarioParticipante + " foi excluído do sistema");
            location.reload(true);
        });
    } 
    
}

function salvarEdicaoEvento (idEvento) {
    var selectEventInput= $("#eventoNome");
    var selectEventName = selectEventInput.val();

    $.post("../model/criaEvento.php", { novoNome: selectEventName, idEvento: idEvento }, function(data) {
        location.reload(true);    
    });

}

function removeEvento (idEvento) {
    var confirmacao = confirm("Tem certeza que deseja excluir este evento?");
    
    if (confirmacao) {
        $.post("../model/exclui.php", { idEvento: idEvento }, function(data) {
            alert("Evento com ID: " + idEvento + " foi excluído do sistema");
            location.reload(true);
        });
    } 
}