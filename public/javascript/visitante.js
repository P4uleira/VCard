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


});

async function iniciarCamera() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        const video = document.getElementById('video');
        video.srcObject = stream;
        video.style.display = 'block';

        // Aqui você pode usar uma biblioteca para fazer a leitura do QR Code, como o 'instascan' ou 'jsQR'.
        // Por exemplo, usando 'instascan':
        const scanner = new Instascan.Scanner({ video: video });
        scanner.addListener('scan', function (content) {
            alert('Código QR lido: ' + content);
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('Nenhuma câmera encontrada.');
            }
        });
    } catch (error) {
        console.error('Erro ao acessar a câmera: ', error);
    }
}