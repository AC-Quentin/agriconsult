document.getElementById('module').addEventListener('click', function() {
    var moduleSection = document.getElementById('moduleSection');
    var biomasseSection = document.getElementById('biomasseSection');
    var isModuleActive = this.getAttribute('data-variable') === 'true';

    // Si module est déjà actif, le désactiver
    if (isModuleActive) {
        this.setAttribute('data-variable', 'false');
        moduleSection.style.display = 'none';
    } else {
        // Activer module et désactiver biomasse
        this.setAttribute('data-variable', 'true');
        moduleSection.style.display = 'block';

        var biomasseElement = document.getElementById('biomasse');
        biomasseElement.setAttribute('data-variable', 'false');
        biomasseSection.style.display = 'none';

        // Scroll vers la section module
        moduleSection.scrollIntoView({ behavior: 'smooth' });
    }
});

document.getElementById('biomasse').addEventListener('click', function() {
    var biomasseSection = document.getElementById('biomasseSection');
    var moduleSection = document.getElementById('moduleSection');
    var isBiomasseActive = this.getAttribute('data-variable') === 'true';

    // Si biomasse est déjà actif, le désactiver
    if (isBiomasseActive) {
        this.setAttribute('data-variable', 'false');
        biomasseSection.style.display = 'none';
    } else {
        // Activer biomasse et désactiver module
        this.setAttribute('data-variable', 'true');
        biomasseSection.style.display = 'block';

        var moduleElement = document.getElementById('module');
        moduleElement.setAttribute('data-variable', 'false');
        moduleSection.style.display = 'none';

        // Scroll vers la section biomasse
        biomasseSection.scrollIntoView({ behavior: 'smooth' });
    }
});