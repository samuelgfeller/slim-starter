import {removeValidationErrorMessages} from "../../general/ajax/ajax-util/fail-handler.js?v=4.0.0";
import {
    contentEditableFieldValueIsValid,
    disableEditableField,
    makeFieldEditable
} from "../../general/page-component/contenteditable/contenteditable-main.js?v=4.0.0";
import {submitUpdate} from "../../general/ajax/submit-update-data.js?v=4.0.0";

/**
 * Make text value as editable and attach event listeners
 */
export function makeUserFieldEditable() {
    // "this" is the edit icon or the field itself
    let field = this.parentNode.querySelector(this.parentNode.dataset.fieldElement);

    // Make field editable, add save button and focus it
    makeFieldEditable(field);

    // Save btn event listener is not needed as by clicking on the button the focus goes out of the edited field
    field.addEventListener('focusout', validateContentEditableAndSaveUserValue);
}

/**
 * Validate frontend, disable contenteditable and make
 * update request.
 */
function validateContentEditableAndSaveUserValue() {
    // "this" is the field
    if (contentEditableFieldValueIsValid(this)) {
        // Remove validation error messages if any
        removeValidationErrorMessages();
        // Disable contenteditable and save user value
        saveUserValueAndDisableContentEditable(this);
    } else {
        // Lock the focus on the field until the input is valid
        this.focus();
    }
}

/**
 * Make field non-editable and submit user update request
 */
function saveUserValueAndDisableContentEditable(field) {
    disableEditableField(field);
    let userId = document.getElementById('user-id').value;
    let submitValue = field.textContent.trim();
    // submitValue = submitValue === '' ? null : submitValue;

    submitUpdate(
        {[field.dataset.name]: submitValue},
        `users/${userId}`
    ).then(responseJson => {
        // Field disabled before save request and re enabled on error
    }).catch(exception => {
        // If error message contains 422 in the string, make the field editable again
        if (exception.message.includes('422')) {
            makeFieldEditable(field);
            return;
        }

        // If it's a server error, let the user read the error flash message and reloaded the page in 3 seconds
        setTimeout(() => {
            location.reload();
        }, 3000);
    });
}

