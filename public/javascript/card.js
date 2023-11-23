$( document ).ready(function() {
    var estadoCoracao = 0; 
    $("#icon_coracao").click(function(){ 
        if (estadoCoracao == 0) {
            $("#icon_coracao").attr("src","../public/imgs/coracao_vermelho.svg");
            estadoCoracao = 1;
        } else {
            $("#icon_coracao").attr("src","../public/imgs/coracao_branco.svg");
            estadoCoracao = 0;
        }

    });

    var estadoEstrela = 0; 
    $("#icon_star").click(function(){ 
        if (estadoEstrela == 0) {
            $("#icon_star").attr("src","../public/imgs/star_amarela.svg");
            estadoEstrela = 1;
        } else {
            $("#icon_star").attr("src","../public/imgs/star_branca.svg");
            estadoEstrela = 0;
        }

    });


});


function rotacionar(lado) {       

    if (lado == 0) {  
        $("#card_container").css("transform", "rotateY(90deg)");        
        $("#card_container_info_costas").css("transform", "rotateY(180deg)");             
        setTimeout(() => {
            $("#card_container_info").css("display", "none"); 
            $("#card_container_info_costas").css("display", "flex");    
            $("#card_container").css("transform", "rotateY(180deg)"); 
        }, 300);
                     
    } else {
        $("#card_container").css("transform", "rotateY(90deg)");            
        setTimeout(() => {
            $("#card_container_info_costas").css("display", "none");
            $("#card_container_info").css("display", "flex"); 
            $("#card_container").css("transform", "rotateY(0deg)");
        }, 300);                                   
    }
}