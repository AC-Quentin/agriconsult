import './bootstrap.js';
import './styles/app.scss';
import { Tooltip, Toast, Popover } from 'bootstrap';

// Initialisation des tooltips (pour tous les éléments ayant un attribut data-bs-toggle="tooltip")
document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new Tooltip(tooltipTriggerEl);
    });
});

// Initialisation des popovers (pour les éléments ayant l'attribut data-bs-toggle="popover")
document.addEventListener('DOMContentLoaded', function () {
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new Popover(popoverTriggerEl);
    });
});

// Initialisation des toasts (par exemple, pour un élément toast spécifique)
const toastElList = [].slice.call(document.querySelectorAll('.toast'));
const toastList = toastElList.map(function (toastEl) {
    return new Toast(toastEl);
});