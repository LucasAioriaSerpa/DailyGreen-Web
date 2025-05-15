
function btnLogout(){
    const logoutBtn = document.getElementById("logoutBtn");
    logoutBtn.classList.toggle("show");
}

function fetchJsonFile(filePath) {
    return fetch(filePath)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        });
}

function updateOrgSession(newOrgValue) {
    fetch('/DailyGreen-Project/SCRIPTS/PHP/LOGIC/update_org_login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ org: newOrgValue }) // Envia o novo valor de 'org'
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === 'success') {
            console.log('Session updated successfully:', result.message);
            location.reload(); // Recarrega a página para refletir as mudanças
        } else {
            console.error('Failed to update session:', result.message);
        }
    })
    .catch(error => {
        console.error('Error updating session:', error);
    });
}
