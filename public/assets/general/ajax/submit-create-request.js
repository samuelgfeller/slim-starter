import {basePath} from "../general-js/config.js?v=0.0.0";
import {decAjaxCounter, incAjaxCounter} from "./ajax-util/ajax-loading-animation.js?v=0.0.0";
import {handleFail, removeValidationErrorMessages} from "./ajax-util/fail-handler.js?v=0.0.0";

/**
 * Submit POST request to create new resource.
 * @param route
 * @param fieldsAndValues
 * @param {string|null} domFieldId field id to display the validation error message for the correct field * @returns {Promise<void>}
 */
export async function submitCreateRequest(route, fieldsAndValues, domFieldId = null) {
    incAjaxCounter();
    let responseStatus = null;
    return fetch(basePath + route, {
        method: 'POST',
        headers: {"Content-type": "application/json", "Accept": "application/json"},
        body: JSON.stringify(fieldsAndValues)
    })
        .then(async response => {
            responseStatus = response.status;
            if (!response.ok) {
                await handleFail(response, domFieldId);
                // Throw error so it can be caught in catch block (required with status code)
                throw new Error('Response status: ' + response.status);
            }
            // Remove validation error messages if there are any
            removeValidationErrorMessages();
            return response.json();
        })
        .finally(() => {
            decAjaxCounter(responseStatus);
        });
}
