import { Controller } from '@hotwired/stimulus';
import { Tooltip } from 'bootstrap';

export default class extends Controller {
    connect() {
        this.initializeTooltips();
    }

    initializeTooltips() {
        const tooltipTriggerList = [].slice.call(this.element.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new Tooltip(tooltipTriggerEl);
        });
    }
}
