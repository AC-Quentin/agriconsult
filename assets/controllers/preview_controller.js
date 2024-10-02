import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {

            // Cibler les champs OPTIONS et les spans du résumé
            var tableauClientInputs = [
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

            var secheuseClientInputs = document.querySelectorAll(tableauClientInputs.join(','));
            var secheuseResumeClient = document.getElementById('preview-client');
        
                // Fonction pour vérifier si un champ est rempli
                function checkFormClient() {
                let isFormClientFilled = false;
        
                secheuseClientInputs.forEach(function(field) {
                    
                    if (field.type === 'radio' || field.type === 'checkbox') {
                        // Pour les radios ou checkboxes, vérifier si l'un est coché
                        if (field.checked) {
                            isFormClientFilled = true;
                        }
                    } else if (field.value.trim() !== '') {
                        // Pour les champs texte ou autres, vérifier s'il y a une valeur
                        isFormClientFilled = true;
                    }
                });
        
                // Si au moins un champ est rempli, enlever la classe "hidden"
                if (isFormClientFilled) {
                    secheuseResumeClient.classList.remove('hidden');
                } else {
                    secheuseResumeClient.classList.add('hidden');
                }
            }
        
            // Ajouter des écouteurs d'événements sur chaque champ
            secheuseClientInputs.forEach(function(field) {
                field.addEventListener('input', checkFormClient);
                field.addEventListener('change', checkFormClient);
            });

                // ACTIONS SUIVANT LE CHANGEMENT DE VALEUR DES INPUTS
                    var secheuseIDCientInput = document.getElementById('demande_commerciale_form_client_id_client');
                    var secheuseResumeIDClientSpan = document.getElementById('preview-id-client');

                    secheuseIDCientInput.addEventListener('input', function() {
                        secheuseResumeIDClientSpan.textContent = secheuseIDCientInput.value;
                    });

                    var secheuseRaisonSocialeInput = document.getElementById('demande_commerciale_form_client_raison_sociale');
                    var secheuseResumeRaisonSocialeSpan = document.getElementById('preview-raison-sociale');

                    secheuseRaisonSocialeInput.addEventListener('input', function() {
                        secheuseResumeRaisonSocialeSpan.textContent = secheuseRaisonSocialeInput.value;
                    });

                    var secheuseNomPrenomInput = document.getElementById('demande_commerciale_form_client_nom_prenom');
                    var secheuseResumeNomPrenomSpan = document.getElementById('preview-nom-prenom');

                    secheuseNomPrenomInput.addEventListener('input', function() {
                        secheuseResumeNomPrenomSpan.textContent = secheuseNomPrenomInput.value;
                    });

                    var secheuseAdresseInput = document.getElementById('demande_commerciale_form_client_adresse');
                    var secheuseResumeAdresseSpan = document.getElementById('preview-adresse');

                    secheuseAdresseInput.addEventListener('input', function() {
                        secheuseResumeAdresseSpan.textContent = secheuseAdresseInput.value;
                    });

                    var secheuseCodePostalInput = document.getElementById('demande_commerciale_form_client_code_postal');
                    var secheuseResumeCodePostalSpan = document.getElementById('preview-code-postal');

                    secheuseCodePostalInput.addEventListener('input', function() {
                        secheuseResumeCodePostalSpan.textContent = secheuseCodePostalInput.value;
                    });

                    var secheuseVilleInput = document.getElementById('demande_commerciale_form_client_ville');
                    var secheuseResumeVilleSpan = document.getElementById('preview-ville');

                    secheuseVilleInput.addEventListener('input', function() {
                        secheuseResumeVilleSpan.textContent = secheuseVilleInput.value;
                    });

                    var secheuseEmailInput = document.getElementById('demande_commerciale_form_client_email');
                    var secheuseResumeEmailSpan = document.getElementById('preview-email');

                    secheuseEmailInput.addEventListener('input', function() {
                        secheuseResumeEmailSpan.textContent = secheuseEmailInput.value;
                    }); 

                    var secheuseTelephoneInput = document.getElementById('demande_commerciale_form_client_telephone');
                    var secheuseResumeTelephoneSpan = document.getElementById('preview-telephone');

                    secheuseTelephoneInput.addEventListener('input', function() {
                        secheuseResumeTelephoneSpan.textContent = secheuseTelephoneInput.value;
                    });

                    var secheuseMobileInput = document.getElementById('demande_commerciale_form_client_mobile');
                    var secheuseResumeMobileSpan = document.getElementById('preview-mobile');

                    secheuseMobileInput.addEventListener('input', function() {
                        secheuseResumeMobileSpan.textContent = secheuseMobileInput.value;
                    });

        //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


                // Cibler tous les champs du formulaire pour la SECHEUSE
                var formFields = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][QUANTITE]"]');
                var previewElement = document.getElementById('preview-secheuse');
            
                // Fonction pour vérifier si un champ est rempli
                function checkForm() {
                    let isFormFilled = false;
            
                    formFields.forEach(function(field) {
                        if (field.type === 'radio' || field.type === 'checkbox') {
                            // Pour les radios ou checkboxes, vérifier si l'un est coché
                            if (field.checked) {
                                isFormFilled = true;
                            }
                        } else if (field.value.trim() !== '' && field.value.trim() > '0') {
                            // Pour les champs texte ou autres, vérifier s'il y a une valeur
                            isFormFilled = true;
                        }
                    });
            
                    // Si au moins un champ est rempli, enlever la classe "hidden"
                    if (isFormFilled) {
                        previewElement.classList.remove('hidden');
                    } else {
                        previewElement.classList.add('hidden');
                    }
                }
            
                // Ajouter des écouteurs d'événements sur chaque champ
                formFields.forEach(function(field) {
                    field.addEventListener('input', checkForm);
                    field.addEventListener('change', checkForm);
                });

        //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


            // ACTIONS SUIVANT LE CHANGEMENT DE VALEUR DES INPUTS
            var secheuseQuantiteInput = document.getElementById('demande_commerciale_form_secheuse_QUANTITE');
            var secheuseResumeQuantiteSpan = document.getElementById('preview-quantite');

            secheuseQuantiteInput.addEventListener('input', function() {
                secheuseResumeQuantiteSpan.textContent = secheuseQuantiteInput.value;
            });

            // Cibler les boutons radio du champ "TYPE_SECHEUSE"
            var secheuseTypeSecheuseInputs = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][TYPE_SECHEUSE]"]');
            var secheuseResumeTypeSecheuseSpan = document.getElementById('preview-type-secheuse');

            // Ajouter un écouteur d'événements à chaque bouton radio
            secheuseTypeSecheuseInputs.forEach(function(input) {
                input.addEventListener('click', function() {
                    if (input.checked) {          
                        // Mettre à jour le texte du résumé avec la valeur sélectionnée
                        secheuseResumeTypeSecheuseSpan.textContent = input.value + '"';
                    }
                });
            });

            // Cibler les boutons radio du champ "TYPE_PLANCHER"
            var secheuseTypePlancherInputs = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][TYPE_PLANCHER]"]');
            var secheuseResumeTypePlancherSpan = document.getElementById('preview-type-plancher');

            // Ajouter un écouteur d'événements à chaque bouton radio
            secheuseTypePlancherInputs.forEach(function(input) {
                input.addEventListener('click', function() {
                    if (input.checked) {          
                        // Mettre à jour le texte du résumé avec la valeur sélectionnée
                        secheuseResumeTypePlancherSpan.textContent = input.value;
                    }
                });
            });

            // Cibler les boutons radio du champ "TYPE_REPRISE"
            var secheuseTypeRepriseInputs = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][TYPE_REPRISE]"]');
            var secheuseResumeTypeRepriseSpan = document.getElementById('preview-type-reprise');

            // Ajouter un écouteur d'événements à chaque bouton radio
            secheuseTypeRepriseInputs.forEach(function(input) {
                input.addEventListener('click', function() {
                    if (input.checked) {          
                        // Mettre à jour le texte du résumé avec la valeur sélectionnée
                        secheuseResumeTypeRepriseSpan.textContent = input.value;
                    }
                });
            });

            // Cibler les boutons radio du champ "DEBIT_REPRISE"
            var secheuseDebitRepriseInputs = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][DEBIT_REPRISE]"]');
            var secheuseResumeDebitRepriseSpan = document.getElementById('preview-debit-reprise');

            // Ajouter un écouteur d'événements à chaque bouton radio
            secheuseDebitRepriseInputs.forEach(function(input) {
                input.addEventListener('click', function() {
                    if (input.checked) {          
                        // Mettre à jour le texte du résumé avec la valeur sélectionnée
                        secheuseResumeDebitRepriseSpan.textContent = input.value + 'T/h';
                    }
                });
            });

            // Cibler les boutons radio du champ "TYPE_MODULE"
            var secheuseTypeModuleInputs = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][TYPE_MODULE]"]');
            var secheuseResumeTypeModuleSpan = document.getElementById('preview-type-module');

            // Ajouter un écouteur d'événements à chaque bouton radio
            secheuseTypeModuleInputs.forEach(function(input) {
                input.addEventListener('click', function() {
                    if (input.checked) {          
                        // Mettre à jour le texte du résumé avec la valeur sélectionnée
                        secheuseResumeTypeModuleSpan.textContent = input.value + 'CV';
                    }
                });
            });

            // Cibler les boutons radio du champ "GAZ"
            var secheuseGazInputs = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][GAZ]"]');
            var secheuseResumeGazSpan = document.getElementById('preview-gaz');

            // Ajouter un écouteur d'événements à chaque bouton radio
            secheuseGazInputs.forEach(function(option) {
                option.addEventListener('click', function() {
                    // Met à jour le texte lorsque la valeur change
                    secheuseResumeGazSpan.textContent = this.value;
                });
            });

            // Cibler les boutons radio du champ "BIOMASSE"
            var secheuseBiomasseInputs = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][BIOMASSE]"]');
            var secheuseResumeBiomasseSpan = document.getElementById('preview-biomasse');

            // Ajouter un écouteur d'événements à chaque bouton radio
            secheuseBiomasseInputs.forEach(function(input) {
                input.addEventListener('click', function() {
                    if (input.checked) {          
                        // Mettre à jour le texte du résumé avec la valeur sélectionnée
                        secheuseResumeBiomasseSpan.textContent = input.value;
                    }
                });
            });

        // ACTIONS CLICK MODULE / BIOMASSE ----------------------------------------------------------------
        var secheuseModule = document.getElementById('TXT_MODULE');
        var secheuseModuleActif = document.getElementById('preview-biomasse');
        var secheuseResetBiomasseValue = document.getElementById('demande_commerciale_form_secheuse_BIOMASSE');

        secheuseModule.addEventListener('click', function() {
            secheuseModuleActif.textContent = '';
            secheuseResetBiomasseValue.value = '';
        });

        var secheuseBiomasse = document.getElementById('TXT_BIOMASSE');
        var secheuseBiomasseActif = document.getElementById('preview-type-module');
        var secheuseBiomasseActif2 = document.getElementById('preview-gaz');
        var secheuseResetTypeModuleValue = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][TYPE_MODULE]"]');
        var secheuseResetGazValue = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][GAZ]"]');

        // Réinitialisation des aperçus texte lors du clic sur "secheuseBiomasse"
        secheuseBiomasse.addEventListener('click', function() {
            secheuseBiomasseActif.textContent = '';
            secheuseBiomasseActif2.textContent = '';
            secheuseResetGazValue.forEach(function(input) {
                input.checked = false
            });
            secheuseResetTypeModuleValue.forEach(function(input) {
                input.checked = false
            });
        });


            //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

                // Cibler les champs OPTIONS et les spans du résumé
                var tableauOptionsInputs = ['select[name="demande_commerciale_form[secheuse][VIS_BRASSAGE]"]',
                    'select[name="demande_commerciale_form[secheuse][PRENETTOYEUR]"]',
                    'select[name="demande_commerciale_form[secheuse][B2D]"]',
                    'select[name="demande_commerciale_form[secheuse][DEBIT_VIS]"]'];

            var secheuseOptionsInputs = document.querySelectorAll(tableauOptionsInputs.join(','));
            var secheuseResumeOptions = document.getElementById('preview-options');
        
                // Fonction pour vérifier si un champ est rempli
                function checkFormOptions() {
                let isFormOptionsFilled = false;
        
                secheuseOptionsInputs.forEach(function(field) {
                    if (field.value !== '') {
                        // Vérifier si une option autre que l'option vide (valeur '0') est sélectionnée
                        isFormOptionsFilled = true;
                    }
                });
        
                // Si au moins un champ est rempli, enlever la classe "hidden"
                if (isFormOptionsFilled) {
                    secheuseResumeOptions.classList.remove('hidden');
                } else {
                    secheuseResumeOptions.classList.add('hidden');
                }
            }
        
            // Ajouter des écouteurs d'événements sur chaque champ
            secheuseOptionsInputs.forEach(function(field) {
                field.addEventListener('input', checkFormOptions);
                field.addEventListener('change', checkFormOptions);

            });

                    // VIS BRASSAGE
                    var secheuseOptionVisBrassage = document.querySelectorAll('select[name="demande_commerciale_form[secheuse][VIS_BRASSAGE]"]');
                    var secheuseResumeOptionVisBrassage = document.getElementById('preview-vis-brassage');
                
                    // Boucle sur tous les éléments récupérés par querySelectorAll
                    secheuseOptionVisBrassage.forEach(function(option) {
                        option.addEventListener('change', function() {
                            // Met à jour le texte lorsque la valeur change
                            secheuseResumeOptionVisBrassage.textContent = this.value;
                        });
                    });

                    // PRENETTOYEUR
                    var secheuseOptionPrenettoyeur = document.querySelectorAll('select[name="demande_commerciale_form[secheuse][PRENETTOYEUR]"]');
                    var secheuseResumeOptionPrenettoyeur = document.getElementById('preview-prenettoyeur');
                
                        // Boucle sur tous les éléments récupérés par querySelectorAll
                        secheuseOptionPrenettoyeur.forEach(function(option) {
                            option.addEventListener('change', function() {
                                // Met à jour le texte lorsque la valeur change
                                secheuseResumeOptionPrenettoyeur.textContent = this.value;
                            });
                        });

                    // B2D
                    var secheuseOptionB2D = document.querySelectorAll('select[name="demande_commerciale_form[secheuse][B2D]"]');
                    var secheuseResumeOptionB2D = document.getElementById('preview-b2d');
                
                    // Boucle sur tous les éléments récupérés par querySelectorAll
                    secheuseOptionB2D.forEach(function(option) {
                        option.addEventListener('change', function() {
                            // Met à jour le texte lorsque la valeur change
                            secheuseResumeOptionB2D.textContent = this.value;
                        });
                    });

                        // DEBIT VIS   
                        var secheuseOptionDebitVis = document.querySelectorAll('select[name="demande_commerciale_form[secheuse][DEBIT_VIS]"]');
                        var secheuseResumeOptionDebitVis = document.getElementById('preview-debit-vis');

                        // Boucle sur tous les éléments récupérés par querySelectorAll
                        secheuseOptionDebitVis.forEach(function(option) {
                            option.addEventListener('change', function() {
                                // Met à jour le texte lorsque la valeur change
                                secheuseResumeOptionDebitVis.textContent = this.value;
                            });
                        });

        //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

                // Cibler les champs OPTIONS et les spans du résumé          
            var secheuseVisMobileInputs = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][VIS_MOBILE]"]');
            var secheuseResumeVisMobile = document.getElementById('preview-card-vis-mobile');
        
                // Fonction pour vérifier si un champ est rempli
                function checkFormVisMobile() {
                let isFormVisMobileFilled = false;
        
                secheuseVisMobileInputs.forEach(function(field) {
                    
                    if (field.type === 'radio' || field.type === 'checkbox') {
                        // Pour les radios ou checkboxes, vérifier si l'un est coché
                        if (field.checked) {
                            isFormVisMobileFilled = true;
                        }
                    } else if (field.value.trim() !== '') {
                        // Pour les champs texte ou autres, vérifier s'il y a une valeur
                        isFormVisMobileFilled = true;
                    }
                });
        
                // Si au moins un champ est rempli, enlever la classe "hidden"
                if (isFormVisMobileFilled) {
                    secheuseResumeVisMobile.classList.remove('hidden');
                } else {
                    secheuseResumeVisMobile.classList.add('hidden');
                }
            }
        
            // Ajouter des écouteurs d'événements sur chaque champ
            secheuseVisMobileInputs.forEach(function(field) {
                field.addEventListener('input', checkFormVisMobile);
                field.addEventListener('change', checkFormVisMobile);
                field.addEventListener('click', checkFormVisMobile);
            });
        
            // ACTIONS SUIVANT LE CHANGEMENT DE VALEUR DES INPUTS
            // VIS MOBILE
            var secheuseOptionVisMobile = document.querySelectorAll('input[name="demande_commerciale_form[secheuse][VIS_MOBILE]"]');
            var secheuseResumeOptionVisMobile = document.getElementById('preview-vis-mobile');
        
            // Boucle sur tous les éléments récupérés par querySelectorAll
            secheuseOptionVisMobile.forEach(function(input) {
                input.addEventListener('click', function() {
                    // Met à jour le texte lorsque la valeur change
                    if (input.checked) {          
                        // Mettre à jour le texte du résumé avec la valeur sélectionnée
                        secheuseResumeOptionVisMobile.textContent = input.value;
                        }
                });
            });

            // VIS MOBILE BAC
            var secheuseOptionVisMobileBac = document.querySelectorAll('select[name="demande_commerciale_form[secheuse][VIS_MOBILE_BAC]"]');
            var secheuseResumeOptionVisMobileBac = document.getElementById('preview-vis-mobile-bac');
                
            // Boucle sur tous les éléments récupérés par querySelectorAll
            secheuseOptionVisMobileBac.forEach(function(option) {
                option.addEventListener('change', function() {
                // Met à jour le texte lorsque la valeur change
                secheuseResumeOptionVisMobileBac.textContent = this.value;
                });
            });
            
            // VIS MOBILE SORTIE ORIENTABLE
            var secheuseOptionVisMobileSortieOrientable = document.querySelectorAll('select[name="demande_commerciale_form[secheuse][VIS_MOBILE_SORTIE_ORIENTABLE]"]');
            var secheuseResumeOptionVisMobileSortieOrientable = document.getElementById('preview-vis-mobile-sortie-orientable');
                
            // Boucle sur tous les éléments récupérés par querySelectorAll
            secheuseOptionVisMobileSortieOrientable.forEach(function(option) {
                option.addEventListener('change', function() {
                // Met à jour le texte lorsque la valeur change
                secheuseResumeOptionVisMobileSortieOrientable.textContent = this.value;
                });
            });
        //----------------------------------------------------------------------------------------------------------------------------

        };
}

    

