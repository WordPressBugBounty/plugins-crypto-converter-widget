(function () {
    'use strict';

    var stateKey = '__cryptoConverterWidgetLoader';
    if (window[stateKey]) {
        return;
    }
    window[stateKey] = true;

    var loaderScript = document.currentScript;
    if (!loaderScript || !loaderScript.src) {
        return;
    }

    var loaderUrl = new URL(loaderScript.src, document.baseURI);
    var bundleUrl = new URL('crypto-converter-widget.js', loaderUrl);
    var version = loaderUrl.searchParams.get('ver');
    if (version) {
        bundleUrl.searchParams.set('ver', version);
    }

    var observer = null;

    function cleanup() {
        document.removeEventListener('readystatechange', loadWhenReady);
        window.removeEventListener('load', loadWhenReady);
        if (observer) {
            observer.disconnect();
            observer = null;
        }
    }

    function loadWhenReady() {
        if (
            document.readyState !== 'complete' ||
            !document.body ||
            !document.body.isConnected
        ) {
            return;
        }

        cleanup();

        if (customElements.get('crypto-converter-widget')) {
            return;
        }

        var existingBundle = document.querySelector('script[data-ccw-widget-bundle]');
        if (existingBundle) {
            return;
        }

        var bundleScript = document.createElement('script');
        bundleScript.src = bundleUrl.toString();
        bundleScript.async = true;
        bundleScript.dataset.ccwWidgetBundle = 'true';
        if (loaderScript.nonce) {
            bundleScript.nonce = loaderScript.nonce;
        }

        (document.head || document.body).appendChild(bundleScript);
    }

    document.addEventListener('readystatechange', loadWhenReady);
    window.addEventListener('load', loadWhenReady);
    observer = new MutationObserver(loadWhenReady);
    observer.observe(document, { childList: true, subtree: true });
    loadWhenReady();
}());
