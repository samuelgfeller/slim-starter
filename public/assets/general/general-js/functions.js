/**
 * These functions could be added to the js String properties
 * like shown in https://stackoverflow.com/a/3291856/9013718,
 * but I think @aggregate1166877 mentions an important factor to consider
 * which is that it could break other code.
 */


/**
 * For data retrieved with Ajax, the html escape has to be done in the frontend.
 * https://stackoverflow.com/questions/6366849/html-escaping-the-data-returned-from-ajax-json
 *
 * Source: https://stackoverflow.com/questions/6234773/can-i-escape-html-special-chars-in-javascript
 *
 * @param {string|number} unsafeString
 * @return {string}
 */
export function html(unsafeString) {
    // Number has not the function replace() hence toString()
    return unsafeString?.toString()
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

/**
 * Translate a string based on the translations added to the template with php gettext.
 * Translations are loaded into window.translations in initiation.js.
 * This function is to access the translation keys in js.
 * Example: __('Hello World') or __('Hello %s', 'World')
 * @param {string} key
 * @param args optional arguments to replace in translation string. %s and %d are supported.
 * @returns {string}
 */
export function __(key, ...args) {
    let translation = window.translations && window.translations[key] ? window.translations[key] : key;

    if (args.length > 0) {
        args.forEach(arg => {
            translation = translation.replace(/%s|%d/, arg);
        });
    }
    return translation;
}

