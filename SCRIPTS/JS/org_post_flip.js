function fetchJsonFile(filePath) {
    return fetch(filePath)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        });
}

function sendJsonData(data) {
    fetch('/DailyGreen-Project/SCRIPTS/PHP/LOGIC/update_org_login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        console.log('Data sent successfully:', result);
    })
    .catch(error => {
        console.error('Error sending data:', error);
    });
}

function turnORG(bool) {
    fetchJsonFile('/DailyGreen-Project/JSON/login.json')
        .then(data => {
            data.org = bool;
            sendJsonData(data);
            location.reload();
        })
        .catch(error => {
            console.error('Error processing JSON data:', error);
        });
}