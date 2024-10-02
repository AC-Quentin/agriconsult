import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const reset = document.getElementById('vis_mobile_reset');

        // Vérifier si le formulaire existe
        if (reset) {
            reset.addEventListener('click', this.reset);
        } else {
            console.error('Form not found');
        }
    }

    reset() {
            // Liste des champs du formulaire à réinitialiser
            const tableauVisMobileInputs = [
                'input[name="demande_commerciale_form[secheuse][VIS_MOBILE]"]',
                'select[name="demande_commerciale_form[secheuse][VIS_MOBILE_BAC]"]',
                'select[name="demande_commerciale_form[secheuse][VIS_MOBILE_SORTIE_ORIENTABLE]"]',
            ];

            // Sélectionner les champs du formulaire
            const secheuseVisMobileInputs = document.querySelectorAll(tableauVisMobileInputs.join(','));

            var tableauKeyValuesInput = {
                "demande_commerciale_form[secheuse][VIS_MOBILE]": "preview-vis-mobile",
                "demande_commerciale_form[secheuse][VIS_MOBILE_BAC]": "preview-vis-mobile-bac",
                "demande_commerciale_form[secheuse][VIS_MOBILE_SORTIE_ORIENTABLE]": "preview-vis-mobile-sortie-orientable",
            };

            // Réinitialiser chaque champ
            secheuseVisMobileInputs.forEach((node) => {
                node.checked = false;
                node.selectedIndex = "0";                
                var getIdInput = tableauKeyValuesInput[node.name];
                var getPreview = document.getElementById(getIdInput);
                if (getPreview) {
                    getPreview.innerHTML = "";
                }
            });

            var secheuseResumeVisMobile = document.getElementById('preview-card-vis-mobile');
            secheuseResumeVisMobile.classList.add('hidden');
            
            console.log("Client form has been reset.");

    }
}
