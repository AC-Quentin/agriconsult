import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        document.querySelectorAll('.image-choice img').forEach(img => {
            img.addEventListener('click', function() {
                const radioId = this.getAttribute('data-radio-id');
                const radio = document.getElementById(radioId);
                if (radio) {
                    radio.checked = true;
                } else {
                    console.error('Radio button not found for ID: ' + radioId);
                }
            });
        });
    }
}
