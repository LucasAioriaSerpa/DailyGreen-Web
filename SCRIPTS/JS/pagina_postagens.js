
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

const arrayMotivos = {
    Spam:[
        "Divulgação de links repetitivos e irrelevantes.",
        "Envio de mensagens em massa nos comentários.",
        "Promoção não autorizada de produtos ou serviços."
    ],
    Conteudo_fora_do_tema:[
        "Postagens que não se relacionam com os tópicos do fórum.",
        "Comentários que desviam do foco da discussão.",
        "Publicações com assuntos pessoais ou irrelevantes."
    ],
    Linguagem_inadequada:[
        "Uso excessivo de palavrões.",
        "Comentários sarcásticos ou provocativos.",
        "Mensagens com tom agressivo sem ofensas diretas."
    ],
    Publicacao_duplicada:[
        "Repetição do mesmo post em diferentes categorias.",
        "Comentários copiados e colados em várias discussões.",
        "Reenvio de conteúdo já removido/moderado anteriormente."
    ],
    Informacoes_incorretas:[
        "Disseminação de dados ambientais sem fonte confiável.",
        "Distorção de fatos sobre temas sustentáveis.",
        "Compartilhamento de dicas ou práticas prejudiciais ao meio ambiente."
    ],
    Discurso_de_odio:[
        "Comentários com preconceito racial, religioso, de gênero ou orientação sexual.",
        "Ofensas a minorias ou grupos sociais.",
        "Uso de termos discriminatórios ou incitação à violência."
    ],
    Assedio_ou_perseguicao:[
        "Ataques direcionados a um ou mais usuários.",
        "Envio repetido de mensagens indesejadas com teor ofensivo.",
        "Tentativas de intimidar ou humilhar alguém na plataforma."
    ],
    Incitacao_a_praticas_ilegais:[
        "Apologia ao crime ambiental (como desmatamento ou caça ilegal).",
        "Incentivo ao descumprimento de leis de proteção ambiental.",
        "Compartilhamento de conteúdo sobre atividades ilegais."
    ],
    Conteudo_improprio_ou_explicito:[
        "Imagens ou vídeos com nudez ou violência.",
        "Divulgação de material gráfico que fere a política da plataforma."
    ]
}

function updateMotivo(){
    const titulo = document.getElementById("titulo").value;
    const motivo = document.getElementById("motivo");

    console.log("Título selecionado:", titulo);
    console.log("Existe no arrayMotivos?", arrayMotivos.hasOwnProperty(titulo));

    motivo.innerHTML = "";

    if (titulo && arrayMotivos[titulo]) {
        // Adiciona um option padrão
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.text = "--- Selecione ---";
        motivo.appendChild(defaultOption);

        // Adiciona os novos motivos
        arrayMotivos[titulo].forEach(function(op) {
            const option = document.createElement("option");
            option.value = op;
            option.text = op;
            motivo.appendChild(option);
        });
    }
}

function confirmSendDenuncia(){
    Swal.fire({
        title: "Confirma a denúncia desta conta?",
        text: "Após confirmada, a denúncia não poderá ser desfeita.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Denúncia enviada com sucesso!",
                    icon: "success",
                    draggable: true
                }).then((result) => {
                    document.querySelector(".form_denuncia").submit();
                })
            }
        }
    );
}

//------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.querySelector('.edit-btn');
    const editModal = document.getElementById('editModal');
    const bioForm = document.getElementById('bioForm');
    const cancelBtn = document.getElementById('cancelBtn');
    
    // Abre o modal quando clicar no botão de editar
    editBtn.addEventListener('click', function() {
        editModal.style.display = 'flex';
    });
    
    // Fecha o modal quando enviar o formulário
    bioForm.addEventListener('submit', function(e) {
        
        // Aqui você pode adicionar a lógica para salvar a biografia
        const novaBiografia = document.getElementById('biografia').value;
        console.log('Nova biografia:', novaBiografia);
        
        // Fecha o modal
        editModal.style.display = 'none';
    });
    
    // Fecha o modal quando clicar no botão cancelar
    cancelBtn.addEventListener('click', function() {
        editModal.style.display = 'none';
    });
    
    // Fecha o modal se clicar fora do formulário
    editModal.addEventListener('click', function(e) {
        if (e.target === editModal) {
            editModal.style.display = 'none';
        }
    });
});
