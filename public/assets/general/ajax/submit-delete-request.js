import {handleFail} from "./ajax-util/fail-handler.js?v=4.0.1";
import {basePath} from "../general-js/config.js?v=4.0.1";
import {decAjaxCounter, incAjaxCounter} from "./ajax-util/ajax-loading-animation.js?v=4.0.1";


/**
 * Send DELETE request.
 *
 * @param {string} route after base path (e.g. 'users/1')
 * @return {Promise} with as content server response as JSON
 */
export function submitDelete(route) {
    incAjaxCounter();
    let responseStatus = null;
    return fetch(basePath + route, {
        method: 'DELETE',
        headers: {"Content-type": "application/json", "Accept": "application/json"}
    })
        .then(async response => {
            responseStatus = response.status;

            if (!response.ok) {
                await handleFail(response);
                // Throw error so it can be caught in catch block
                throw new Error('Response status: ' + response.status);
            }
            return response.json();
        }).finally(() => {
            decAjaxCounter(responseStatus);
        });
}
