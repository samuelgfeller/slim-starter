import {makeUserFieldEditable} from "./user-update-contenteditable.js?v=0.0.0";
import {submitDelete} from "../../general/ajax/submit-delete-request.js?v=0.0.0";
import {createAlertModal} from "../../general/page-component/modal/alert-modal.js?v=0.0.0";


const userId = document.getElementById('user-id').value;

// Documentation: https://samuel-gfeller.ch/docs/JavaScript-Frontend#contenteditable-fields
// Null safe operator as edit icon doesn't exist if not privileged
document.querySelector('#edit-first-name-btn')?.addEventListener('click', makeUserFieldEditable);
document.querySelector('h1[data-name="first_name"]')?.addEventListener('dblclick', makeUserFieldEditable);
document.querySelector('#edit-last-name-btn')?.addEventListener('click', makeUserFieldEditable);
document.querySelector('h1[data-name="last_name"]')?.addEventListener('dblclick', makeUserFieldEditable);
document.querySelector('#edit-email-btn')?.addEventListener('click', makeUserFieldEditable);
document.querySelector('[data-name="email"]')?.addEventListener('dblclick', makeUserFieldEditable);

// Delete button with null safe as it doesn't exist when not privileged
const userDeleteBtn = document.querySelector('#delete-user-btn');
userDeleteBtn?.addEventListener('click', () => {
    let title = 'Are you sure that you want to delete this user?';
    let info = '';
    createAlertModal(title, info, () => {
        submitDelete(`users/${userId}`).then(() => {
            location.href = `users/list`;
        });
    });
});

// Display all edit icons if touch screen detected because there is no hover
if ('ontouchstart' in window || navigator.msMaxTouchPoints) {
    let editIcons = document.querySelectorAll('.contenteditable-edit-icon');
    for (let editIcon of editIcons) {
        editIcon.classList.toggle('always-displayed-icon');
    }
}