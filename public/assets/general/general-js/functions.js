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
