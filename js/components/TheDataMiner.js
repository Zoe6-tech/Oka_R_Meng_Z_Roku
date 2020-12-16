let errorCodes = {
    404: 'Not found! Please check your URL',
    500: 'Server is not responding.',
    403: 'You shall not pass! Unless you have the creds, then sure go ahead.',
    503: 'Service is unavailable! The servers are all having a coffee break.'
}

async function fetchdata(sourceURL){
    let resource = await fetch(sourceURL).then(response => {
        if (response.status !== 200) { // bang operator - means "does not equal" (or a falsy value)
            throw new Error(`Danger Will Robinson! Here there be monsters! ERROR: ${response.status}`);
        }
        return response;
    })

    // if we get success then we can return back to our resource after we parse it into plain JS
    let dataset = await resource.json();

    return dataset[0];

}

async function postData(sourceURL) {
    return "You are using the postData API endpoint.";
}

export { fetchdata, postData };