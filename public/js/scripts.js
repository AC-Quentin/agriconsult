document.getElementById('SiteClient').addEventListener('show.bs.modal', function () {
    // Empêcher la fermeture du premier modal
    var modalClient = document.getElementById('ModalClient');
    var backdrop = document.querySelector('.modal-backdrop');
    modalClient.style.zIndex = '1040'; // Le z-index du modal parent doit être inférieur à celui du modal enfant
    backdrop.style.zIndex = '1039'; // Ajustement du backdrop
});