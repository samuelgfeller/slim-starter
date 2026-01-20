import {html} from "../../general/general-js/functions.js?v=4.0.1";

/**
 * HTML code for user profile card
 *
 * @return {string}
 * @param {Object} user serialized UserData object
 */
export function getUserCardHtml(user) {
    return `<div class="user-card" tabindex="0" data-user-id="${user.id}">
    <div class="card-content">
        <h3>${user.firstName !== null ? html(user.firstName) : ''} ${user.lastName !== null ? html(user.lastName) : ''}</h3>
        <div class="card-icon-and-span-div">
            <img src="assets/general/general-img/personal-data-icons/email-icon.svg" 
            class="card-icon default-icon-size icon-on-dark-background" alt="email">
            <a href="mailto:${html(user.email)}">${html(user.email)}</a>
        </div>          
    </div>
</div>`;
}

export function getUserCardSkeletonLoaderHtml() {
    return `<div class="user-card-skeleton-loader">
            <!-- CSS Grid -->
            <div class="user-card-name-skeleton-loader">
                <div class="moving-skeleton-loader-part-wrapper">
                    <div class="moving-skeleton-loader-part"></div>
                </div>
            </div>
            <div class="user-card-email-container">
                <div class="moving-skeleton-loader-part-wrapper">
                    <div class="moving-skeleton-loader-part"></div>
                </div>
                <div class="moving-skeleton-loader-part-wrapper">
                    <div class="moving-skeleton-loader-part"></div>
                </div>
            </div>
    </div>`;
}
