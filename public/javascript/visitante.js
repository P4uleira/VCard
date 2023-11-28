$(document).ready(function(){    
    $("#organizacao").change(function(){        
        var idOrg = $(this).val();       

        window.location.href = "../views/visitante.php?modo=tCard&orgSelect=" + idOrg;      
      
    });

    $("#eventos").change(function(){ 
        var idEvent = $(this).val();
        var url = new URL(window.location.href);       
        var idOrg = url.searchParams.get("orgSelect");       

        window.location.href = "../views/visitante.php?modo=tCard&orgSelect=" + idOrg + "&evento=" + idEvent;      
      
    });


  });


//function organizacaoSelecionada() {
    //var idOrg = $(this).val();    
    
    //window.location.href = "../views/visitante.php?modo=tCard&orgSelect=" + idOrg;
//}