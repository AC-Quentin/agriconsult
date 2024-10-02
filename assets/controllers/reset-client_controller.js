import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const reset = document.getElementById('client_reset');

        // Vérifier si le formulaire existe
        if (reset) {
            reset.addEventListener('click', this.reset);
        } else {
            console.error('Form not found');
        }
    }

    reset() {
            // Liste des champs du formulaire à réinitialiser
            const tableauClientInputs = [
                'input[name="demande_commerciale_form[client][id_client]"]',
                'input[name="demande_commerciale_form[client][raison_sociale]"]',
                'input[name="demande_commerciale_form[client][nom_prenom]"]',
                'input[name="demande_commerciale_form[client][adresse]"]',
                'input[name="demande_commerciale_form[client][code_postal]"]',
                'input[name="demande_commerciale_form[client][ville]"]',
                'input[name="demande_commerciale_form[client][email]"]',
                'input[name="demande_commerciale_form[client][telephone]"]',
                'input[name="demande_commerciale_form[client][mobile]"]',
            ];

            // Sélectionner les champs du formulaire
            const secheuseClientInputs = document.querySelectorAll(tableauClientInputs.join(','));

            var tableauKeyValuesInput = {
                "demande_commerciale_form[client][id_client]": "preview-id-client",
                "demande_commerciale_form[client][raison_sociale]": "preview-raison-sociale",
                "demande_commerciale_form[client][nom_prenom]": "preview-nom-prenom",
                "demande_commerciale_form[client][adresse]": "preview-adresse",
                "demande_commerciale_form[client][code_postal]": "preview-code-postal",
                "demande_commerciale_form[client][ville]": "preview-ville",
                "demande_commerciale_form[client][email]": "preview-email",
                "demande_commerciale_form[client][telephone]": "preview-telephone",
                "demande_commerciale_form[client][mobile]": "preview-mobile",
            };

            // Réinitialiser chaque champ
            secheuseClientInputs.forEach((node) => {
                node.value = "";
                var getIdInput = tableauKeyValuesInput[node.name];
                console.log(getIdInput);
                var getPreview = document.getElementById(getIdInput);
                console.log(getPreview);
                if (getPreview) {
                    getPreview.innerHTML = "";
                }
            });

            var secheuseResumeClient = document.getElementById('preview-client');
            secheuseResumeClient.classList.add('hidden');
            
            console.log("Client form has been reset.");

    }
}
