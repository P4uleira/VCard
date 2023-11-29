function removeCard(idCard) {
    var confirmacao = confirm("Tem certeza que deseja excluir este Card?");
    
    if (confirmacao) {
        $.post("../model/exclui.php", { idCard: idCard }, function(data) {            
            location.reload(true);
        });
    } 
}

function cardSelecionado() {
    var selectCard = $("#editCard");
    var cardSelected = selectCard.val();    
    
    window.location.href = "../views/participante.php?modo=eCard&card=" + cardSelected;
}

function eventoParticipar() {
    var eventoSeleciona = $("#eventoParticipa");
    var eventoSelected = eventoSeleciona.val();    
    
    window.location.href = "../views/participante.php?modo=eEvento&evento=" + eventoSelected;
}