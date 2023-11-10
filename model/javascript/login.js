function validaCadastro(){
    var userNickname = $("#nickname");

    $.post("../model/sql.php", { nome: usuarioParticipante }, function(data) {
        alert("Usuario: " + usuarioParticipante + " foi excluído do sistema");
        location.reload(true);
    });
}