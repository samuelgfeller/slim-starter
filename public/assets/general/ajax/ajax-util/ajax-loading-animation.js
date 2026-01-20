// Global AJAX loading indicator controls (header)
function getHeaderEl() {
    return document.querySelector('header');
}
function setHeaderLoading(active) {
    const header = getHeaderEl();
    if (!header) return;
    if (active) {
        header.classList.add('ajax-loading');
        header.classList.remove('ajax-loaded');
    } else {
        header.classList.remove('ajax-loading');
    }
}

function flashHeaderLoaded(responseStatus) {
    const header = getHeaderEl();
    if (!header) return;
    header.classList.add('ajax-loaded');
    const isError = responseStatus >= 400 && responseStatus < 600;
    if (isError) {
        header.classList.add('ajax-error');
    }
    // Remove the loaded class after a short delay for a subtle flash effect°
    setTimeout(() => {
        header.classList.remove('ajax-loaded');
        if (isError) {
            header.classList.remove('ajax-error');
        }
    }, 800);
}


export function incAjaxCounter() {
    window.__ajaxPendingCount = (window.__ajaxPendingCount || 0) + 1;
    setHeaderLoading(true);
}
export function decAjaxCounter(responseStatus) {
    window.__ajaxPendingCount = Math.max(0, (window.__ajaxPendingCount || 0) - 1);
    if (window.__ajaxPendingCount === 0) {
        setHeaderLoading(false);
        flashHeaderLoaded(responseStatus);
    }
}
