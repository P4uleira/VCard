$(document).ready(function () {
    $("#organizacao").change(function () {
        var idOrg = $(this).val();

        window.location.href = "../views/visitante.php?modo=tCard&orgSelect=" + idOrg;

    });

    $("#eventos").change(function () {
        var idEvent = $(this).val();
        var url = new URL(window.location.href);
        var idOrg = url.searchParams.get("orgSelect");

        window.location.href = "../views/visitante.php?modo=tCard&orgSelect=" + idOrg + "&evento=" + idEvent;

    });

    $("#reader__dashboard_section_csr > div > button").addClass("btn btn-primary");
    $("#reader__filescan_input").addClass("btn btn-primary");
    

});

function onScanSuccess(qrCodeMessage) {
    $("#resultadoDoScan").css("display", "inline");    
    document.getElementById('result').href = qrCodeMessage;

}
function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);