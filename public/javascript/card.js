$( document ).ready(function() {   
    var estadoEstrela = 0; 
    $("#icon_star").click(function(){ 
            var url = new URL(window.location.href);       
            var idCard = url.searchParams.get("id");
        if (estadoEstrela == 0) {
            $("#icon_star").attr("src","../public/imgs/star_amarela.svg");
            estadoEstrela = 1;             

            $.post("../views/card.php", { id: idCard, fav: estadoEstrela  }, function(data) { 
                location.reload(true);                          
            });

        } else {
            $("#icon_star").attr("src","../public/imgs/star_branca.svg");            
            estadoEstrela = 0;           

            $.post("../views/card.php", { id: idCard, fav: estadoEstrela  }, function(data) { 
                location.reload(true);                          
            });
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