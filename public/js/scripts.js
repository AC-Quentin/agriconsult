
reload();
document.addEventListener('DOMContentLoaded', function() {

alert('test')

    const container = document.querySelector('.card-body'); // Sélectionner le conteneur principal
    const fields = Array.from(container.querySelectorAll('.mb-3.hidden')); // Sélectionner les divs avec les classes .mb-3.hidden

    function showNextField() {
        const nextField = fields.shift();
        if (nextField) {
            nextField.classList.remove('hidden');
        }
    }

    container.addEventListener('input', function(event) {
        if (fields.length > 0) {
            showNextField();
        }
    });

});
