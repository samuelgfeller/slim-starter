import {loadUserList} from "./user-list-loading.js?v=4.0.1";

// Load user list at page load. In a separate file as it's used by user-create-main as well.
loadUserList();