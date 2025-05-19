
function openModal(src) {
    const modal = document.getElementById('imgModal');
    const modalImg = document.getElementById('imgModalContent');
    modalImg.src = src;
    modal.classList.add('show');
}

function closeModal(e) {
    if (!e || e.target === document.getElementById('imgModal') || e.target.classList.contains('img-modal-close')) {
        document.getElementById('imgModal').classList.remove('show');
    }
}

function btnLogout() {
    const logoutBtn = document.getElementById("logoutBtn");
    logoutBtn.classList.toggle("show");
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
