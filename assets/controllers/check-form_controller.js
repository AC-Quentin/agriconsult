import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    connect() {
        const form = document.getElementById('check-form-submit');

        // Vérifier si le formulaire existe
        if (form) {
            form.addEventListener('click', this.handleSubmit.bind(this)); // Bind pour garder le bon contexte de `this`
        } else {
            console.error('Form not found');
        }
    }

    handleSubmit(event) {

        const form_submit = document.getElementById('form_submit');
        const alert_check_form_submit = document.getElementById('alert_check_form_submit');
        var check = true; // Initialisé à true pour pouvoir le changer si nécessaire

        // Empêcher la soumission par défaut
        event.preventDefault();

        const input_form = [
            'input[name="demande_commerciale_form[client][id_client]"]',
            'input[name="demande_commerciale_form[client][raison_sociale]"]',
            'input[name="demande_commerciale_form[secheuse][QUANTITE]"]',
            'input[name="demande_commerciale_form[secheuse][TYPE_SECHEUSE]"]',
            'input[name="demande_commerciale_form[secheuse][TYPE_PLANCHER]"]',
            'input[name="demande_commerciale_form[secheuse][TYPE_REPRISE]"]',
            'input[name="demande_commerciale_form[secheuse][DEBIT_REPRISE]"]',
        ];

        const check_node_form = document.querySelectorAll(input_form);
        console.log(check_node_form);

        var tableauKeyValuesInput = {
            "demande_commerciale_form[client][id_client]": "Id client",
            "demande_commerciale_form[client][raison_sociale]": "Raison sociale",
            "demande_commerciale_form[secheuse][QUANTITE]": "Quantité",
            "demande_commerciale_form[secheuse][TYPE_SECHEUSE]": "Type de sécheuse",
            "demande_commerciale_form[secheuse][TYPE_PLANCHER]": "Type de plancher",
            "demande_commerciale_form[secheuse][TYPE_REPRISE]": "Type de reprise",
            "demande_commerciale_form[secheuse][DEBIT_REPRISE]": "Débit de reprise"
        };

        // Vider l'alerte avant la nouvelle vérification
        alert_check_form_submit.innerHTML = '';
        
        // Utiliser un Set pour stocker les `name` des groupes de radio déjà vérifiés
        let radioCheckedSet = new Set();

        check_node_form.forEach((node) => {
            if (node.type === 'radio') {
                // Vérifier si ce groupe de radio a déjà été traité
                if (!radioCheckedSet.has(node.name)) {
                    radioCheckedSet.add(node.name); // Ajouter le `name` au Set

                    // Vérifier si au moins un bouton radio du groupe est coché
                    var radios = document.querySelectorAll(`input[name="${node.name}"]`);
                    var isChecked = Array.from(radios).some(radio => radio.checked);

                    if (!isChecked) {
                        var label = tableauKeyValuesInput[node.name];
                        alert_check_form_submit.innerHTML += 
                            '<div class="alert alert-danger" role="alert"> Veuillez sélectionner une option pour : <strong>' 
                            + label +
                            '</strong></div><br>';      
                        check = false;
                    }
                }
            } else if (node.value === '') {
                // Vérification pour les autres types d'inputs
                var label = tableauKeyValuesInput[node.name];
                alert_check_form_submit.innerHTML += 
                    '<div class="alert alert-danger" role="alert"> Veuillez renseigner le champ : <strong>' 
                    + label +
                    '</strong></div><br>';      
                check = false;
            }
        });

        // Si toutes les vérifications passent, soumettre le formulaire
        if (check) {
            form_submit.submit();
        }
    }
}
