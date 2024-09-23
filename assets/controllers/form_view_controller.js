import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {

        const container = document.querySelector('.card-body'); // Sélectionner le conteneur principal
        const imgContainers = document.querySelectorAll('.image-choice-container'); // Sélectionner tous les conteneurs d'images
        const fields = Array.from(container.querySelectorAll('.mb-3.hidden')); // Sélectionner les divs avec les classes .mb-3.hidden
    
        function showNextField() {
            const nextField = fields.shift();
            if (nextField) {
                nextField.classList.remove('hidden');
                nextField.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    
        // Ajouter l'écouteur de clic pour tous les conteneurs d'images
        imgContainers.forEach(imgContainer => {
            imgContainer.addEventListener('click', function(event) {
                console.error('click');
                const target = event.target;
                if (target.tagName === 'IMG') {
                    const radioId = target.getAttribute('data-radio-id');
                    const radio = document.getElementById(radioId);
                    if (radio) {
                        radio.checked = true;
                        showNextField();
                    } else {
                        console.error('Radio button not found for ID: ' + radioId);
                    }
                }
            });
        });
    
        // Afficher le premier champ pour démarrer le processus
        showNextField();
    }
}

