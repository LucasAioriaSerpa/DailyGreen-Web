
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

function btnDenuncia(denuncia){
    const userAvatar = denuncia.closest('.user-avatar');
    const btnDenuncia = userAvatar.querySelector('.btn-denuncia');

    // Faz com que os outros itens da lista não habilitem o botão quando clicado
    document.querySelectorAll('.btn-denuncia').forEach(btn => {
        if (btn !== btnDenuncia){
            btn.style.display = 'none';
        }
    });

    btnDenuncia.style.display = (btnDenuncia.style.display == 'flex') ? 'none' : 'flex';
}

function formDenuncia(){
    const formularioDenuncia = document.getElementById('formulario-denuncia');
    formularioDenuncia.style.display = (formularioDenuncia.style.display == 'flex') ? 'none' : 'flex';
}

function btnCloseDenuncia(){
    const formularioDenuncia = document.getElementById('formulario-denuncia');
    formularioDenuncia.style.display = 'none';
}