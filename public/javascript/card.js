$( document ).ready(function() {  
    
    var url = new URL(window.location.href);
    var estrela = url.searchParams.get("fav");
    if (estrela === null) {
        // Se não estiver presente, atribui o valor 0 a 'estrela'
        estrela = 0;
    }

    if (estrela == 1) {
        $("#icon_star").attr("src","../public/imgs/star_amarela.svg");
    } else {
        $("#icon_star").attr("src","../public/imgs/star_branca.svg");        
    }

    $("#icon_star").click(function(){ 
               
        var idCard = url.searchParams.get("id");       

        if (estrela == 0) {            
            estrela = 1;
        } else {            
            estrela = 0;
        }

        window.location.href = "../views/card.php?id="+ idCard + "&fav=" + estrela;
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