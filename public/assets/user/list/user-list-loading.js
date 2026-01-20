import {
    displayUserCardSkeletonLoader,
    removeUserCardSkeletonLoader
} from "./user-list-skeleton-loader.js?v=4.0.1";
import {fetchData} from "../../general/ajax/fetch-data.js?v=4.0.1";
import {addUsersToDom} from "./user-list-card-dom-appending.js?v=4.0.1";
import {
    disableMouseWheelClickScrolling,
    openLinkOnHtmlElement
} from "../../general/event-handler/open-link-on-html-element.js?v=4.0.1";
import {
    triggerClickOnHtmlElementEnterKeypress
} from "../../general/event-handler/trigger-click-on-enter-keypress.js?v=4.0.1";

/**
 * Load user list into DOM. Used by user-create-main and user-list-main.
 *
 * @param {string|null} userWrapperId if user wrapper is not the default on the user list page,
 * a custom one can be provided.
 */
export function loadUserList(userWrapperId = null) {
    // Display content placeholder
    displayUserCardSkeletonLoader(userWrapperId);
    // Fetch users
    fetchData('users').then(jsonResponse => {
        removeUserCardSkeletonLoader();
        addUsersToDom(jsonResponse.userDataArray, userWrapperId);
        // Add event listeners to cards
        let userCards = document.querySelectorAll('.user-card');
        for (const card of userCards) {
            // Click on user card
            card.addEventListener('click', openUserReadPageOnCardClick);
            // Middle mouse wheel click
            card.addEventListener('auxclick', openUserReadPageOnCardClick);
            card.addEventListener('mousedown', disableMouseWheelClickScrolling);
            // Enter or space bar key press
            card.addEventListener('keypress', triggerClickOnHtmlElementEnterKeypress);
        }
    }).catch(exception => {
        removeUserCardSkeletonLoader();
    });
}

/**
 * Click on user card event handler
 *
 * @param event
 */
function openUserReadPageOnCardClick(event) {
    // "this" is the card
    openLinkOnHtmlElement(event, this, `users/${this.dataset.userId}`);
}