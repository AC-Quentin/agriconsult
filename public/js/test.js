document.addEventListener('load', function () {
    if (!window.scriptLoaded) {
        alert('test');
        window.scriptLoaded = true;
    }
});