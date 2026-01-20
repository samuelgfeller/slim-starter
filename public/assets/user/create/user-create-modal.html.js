import {createModal} from "../../general/page-component/modal/modal.js?v=4.0.1";

/**
 * Create and display modal box to create a new user.
 */
export function displayUserCreateModal() {
    let header = `<h2>Create user</h2>`;
    let body = `<div>
<form action="javascript:void(0);" class="wide-modal-form" id="create-user-modal-form">
        <div class="form-input-div">
            <label for="first-name-input">First name</label>
            <input type="text" name="first_name" id="first-name-input" placeholder="Hans" class="form-input" 
            minlength="2" maxlength="100" required>
        </div>
        <div class="form-input-div">
            <label for="last-name-input">Last name</label>
            <input type="text" name="last_name" id="last-name-input" placeholder="Zimmer" class="form-input" 
            minlength="2" maxlength="100" required>
        </div>
        <div class="form-input-div">
            <label for="email-input">E-Mail</label>
            <input type="email" name="email" id="email-input" placeholder="mail@example.com" class="form-input" 
            maxlength="254" required autocomplete="off">
        </div>
    </div>`;
    let footer = `<button type="button" id="user-create-submit-btn" class="submit-btn modal-submit-btn">
Create user
    </button></form>
    <div class="clearfix">
    </div>`;
    document.querySelector('body').insertAdjacentHTML('afterbegin', '<div id="create-user-div"></div>');
    let container = document.getElementById('create-user-div');
    createModal(header, body, footer, container, true);
}