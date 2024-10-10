import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        // Récupération du bouton de reinitialisation du formulaire client
        const resetClientForm = document.getElementById('reset-client');
        if (resetClientForm) {
            resetClientForm.addEventListener('click', this.reset.bind(this)); // Bind pour garder le bon contexte de `this`
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

            // Réinitialiser chaque champ du formulaire
            secheuseClientInputs.forEach((node) => {
                node.value = "";
                const previewElementId = tableauKeyValuesInput[node.name];
                const previewElement = document.getElementById(previewElementId);
                
                if (previewElement) {
                    previewElement.innerHTML = "";
                }

                const previewElementParent = document.getElementById('preview-client');
                previewElementParent.classList.add('hidden');
            });
    };

    
}
