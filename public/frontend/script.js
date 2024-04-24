// Get the second segment of the url in case the application is not running in the root directory
// (e.g. localhost/my-app) -> basePath = 'my-app'
const secondUrlSegment = window.location.pathname.split('/')[1];
// If the project is stored in the root directory, the second segment is the 'frontend' folder which means
// that the base path is empty.
const basePath = secondUrlSegment !== 'frontend' ? `/${secondUrlSegment}` : '';
// Replace with the correct API url
const url = basePath + '/api/users';
document.getElementById('request-users-btn').addEventListener('click', () => {
    const outputContainer = document.getElementById('request-output');
    // Output container is hidden by default, remove inline display: none property
    outputContainer.style.display = null;

    // Make Ajax request to fetch users
    fetch(url, {method: 'GET', headers: {"Content-type": "application/json", "Accept": "application/json"}})
        .then(async response => {

            // Display the Access-Control-Allow-Origin header value above the output container
            addAccessControlAllowOriginHeader(response);

            let jsonResponse;
            if (response.headers.get('Content-type') === 'application/json') {
                jsonResponse = await response.json();
            } else {
                outputContainer.className = 'error';
                outputContainer.innerHTML = `The response doesn't contain the Content-type: application/json header.`;
                outputContainer.innerHTML += await response.text();
                return;
            }

            // Display the JSON response in the output container
            outputContainer.innerHTML = prettyPrintJson(jsonResponse);

            // Add red line border output if response is not between 200 and 299
            if (!response.ok) {
                outputContainer.className = 'error';

                if (response.status === 404) {
                    outputContainer.innerHTML = `Invalid API url: ${url}`;
                    return;
                }
                return;
            }

            // Add success class to output container by default
            outputContainer.className = 'success';
        });
});

function prettyPrintJson(jsonResponse) {
    // Pretty print the JSON response
    return JSON.stringify(jsonResponse, null, 2)
        // Replace newlines with <br> and remove \r, \" and \\
        .replace(/\\n/g, '<br>')
        .replace(/\\r/g, '')
        .replace(/\\"/g, '\"')
        .replace(/\\\\/g, '\\');
}

function addAccessControlAllowOriginHeader(response) {
    // Add the Access-Control-Allow-Origin header value as the first line in the output container
    const accessHeaderOutput = document.querySelector('#access-header-output');
    const originHeader = response.headers.get('Access-Control-Allow-Origin');

    if (originHeader) {
        accessHeaderOutput.innerHTML = `Access-Control-Allow-Origin: ${originHeader}`;
        accessHeaderOutput.classList.remove('no-header');
    } else {
        accessHeaderOutput.innerHTML = 'Access-Control-Allow-Origin header not set';
        accessHeaderOutput.classList.add('no-header');
    }
    accessHeaderOutput.style.display = null;
}