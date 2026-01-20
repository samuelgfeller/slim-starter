import {getUserCardHtml} from "./user-list-card.html.js?v=4.0.1";

/**
 * Add elements to page
 *
 * @param {object[]} userDataArray
 * @param {object} statuses
 * @param {string|null} userWrapperId if user wrapper is not the default on the user list page,
 * a custom one can be provided.
 */
export function addUsersToDom(userDataArray, statuses, userWrapperId = null) {
    let container = document.getElementById(userWrapperId ?? 'user-wrapper');

    container.innerHTML = '';

    // If no results, tell user so
    if (userDataArray.length === 0) {
        container.insertAdjacentHTML('beforeend', '<p>No users were found.</p>')
    }

    // Loop over users and add to DOM
    for (const userResult of userDataArray) {
        // Client card HTML
        let cardHtml = getUserCardHtml(userResult, statuses);

        // Add to DOM
        container.insertAdjacentHTML('beforeend', cardHtml);
    }
}