import {
    displayServerSideFlashMessages
} from "../page-component/flash-message/flash-message.js?v=4.0.0";
import {initAutoResizingTextareaElements} from "../page-component/textarea/auto-resizing-textarea.js?v=4.0.0";
import {scrollToAnchor} from "../page-behaviour/scroll-to-anchor.js?v=4.0.0";

// displayFlashMessage('success', 'This is a success flash message.');
// displayFlashMessage('info', 'This is an info flash message.');
// displayFlashMessage('warning', 'This is a warning flash message.');
// displayFlashMessage('error', 'This is an error flash message.');

// "DOMContentLoaded" is fired when the initial HTML document has been completely loaded and parsed,
// without waiting for stylesheets, images, etc. to finish loading
window.addEventListener("DOMContentLoaded", function (event) {
    /** Auto resize textarea elements */
    // initAutoResizingTextareaElements();
});

// "load" is fired when the whole page has loaded, including all dependent resources such as stylesheets, images, etc.
window.addEventListener("load", function (event) {
    /** Slide in server side flash messages */
    displayServerSideFlashMessages();

    /** Scroll to anchor if there is any in the url */
    scrollToAnchor();
});



