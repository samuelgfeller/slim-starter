import {basePath} from "../general-js/config.js?v=4.0.0";
import {handleFail, removeValidationErrorMessages} from "./ajax-util/fail-handler.js?v=4.0.0";


/**
 * Send PUT update request.
 * Fail handled by handleFail() method which supports forms.
 * On success validation errors are removed if there were any and response json returned.
 *
 * @param {object} formFieldsAndValues {field: value} e.g. {[input.name]: input.value}
 * @param {string} route after base path (e.g. users/1)
 * @param {string} domFieldId field id to display the validation error message for the correct field
 * @return {Promise} with as content server response as JSON
 */
export function submitUpdate(formFieldsAndValues, route, domFieldId = null) {

    return fetch(basePath + route, {
        method: 'PUT',
        headers: {"Content-type": "application/json", "Accept": "application/json"},
        body: JSON.stringify(formFieldsAndValues)
    })
        .then(async response => {
            if (!response.ok) {
                await handleFail(response, domFieldId);
                throw new Error('Response status: ' + response.status);
            }
            // Remove validation error messages if there are any
            removeValidationErrorMessages();
            return response.json();
        });
}