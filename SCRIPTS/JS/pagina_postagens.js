
function openMidiaModal(src) {
    const modal = document.getElementById('imgModal');
    const modalImg = document.getElementById('imgModalContent');
    modalImg.src = src;
    modal.classList.add('show');
}

function closeMidiaModal(e) {
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

function openPostModal(post, event, type) {
    const interactiveSelectors = [
        '.btn-reaction-toggle',
        '.btn-comment-toggle',
        '.btn-user-img',
        '.btn-denuncia',
        '.react-container',
        '.comment-modal-content',
        '.formulario-denuncia',
        '.post-img',
        '.img-modal',
        '.img-count',
        '.img-modal-close',
        '.btn-send-checkIn',
        '.btn-send-checkList',
        '.btn-exit-modal-checklist',
        '.checklist-modal-content'
    ];
    if (event) {
        for (const selector of interactiveSelectors) {
            if (event.target.closest(selector)) {
                return;
            }
        }
    }
    const postDivider = post.closest('.'+type+'-divider');
    const postModal = postDivider.querySelector('.post-modal');
    postModal.style.display = 'flex';
}

function closePostModal(btn, type) {
    const postDivider = btn.closest('.'+type+'-divider');
    const postModal = postDivider.querySelector('.post-modal');
    postModal.style.display = 'none';
}

// FORMULÁRIO DE DENÚNCIA

function btnDenuncia(denuncia) {
    const userAvatar = denuncia.closest('.user-avatar');
    const btnDenuncia = userAvatar.querySelector('.btn-denuncia');

    // Esconde todos os outros botões de denúncia
    document.querySelectorAll('.btn-denuncia').forEach(btn => {
        if (btn !== btnDenuncia) {
            btn.style.display = 'none';
        }
    });

    btnDenuncia.style.display = (btnDenuncia.style.display == 'flex') ? 'none' : 'flex';
}

function formDenuncia(button) {
    const postContainer = button.closest('.post');
    const formularioDenuncia = postContainer.querySelector('.formulario-denuncia');
    formularioDenuncia.style.display = (formularioDenuncia.style.display == 'flex') ? 'none' : 'flex';
}

function btnCloseDenuncia(button) {
    const postContainer = button.closest('.post');
    const formularioDenuncia = postContainer.querySelector('.formulario-denuncia');
    formularioDenuncia.style.display = 'none';
}

// LISTA DE MOTIVOS DE DENUNCIAS
const arrayMotivos = {
    Spam: [
        "Divulgação de links repetitivos e irrelevantes.",
        "Envio de mensagens em massa nos comentários.",
        "Promoção não autorizada de produtos ou serviços."
    ],
    Conteudo_fora_do_tema: [
        "Postagens que não se relacionam com os tópicos do fórum.",
        "Comentários que desviam do foco da discussão.",
        "Publicações com assuntos pessoais ou irrelevantes."
    ],
    Linguagem_inadequada: [
        "Uso excessivo de palavrões.",
        "Comentários sarcásticos ou provocativos.",
        "Mensagens com tom agressivo sem ofensas diretas."
    ],
    Publicacao_duplicada: [
        "Repetição do mesmo post em diferentes categorias.",
        "Comentários copiados e colados em várias discussões.",
        "Reenvio de conteúdo já removido/moderado anteriormente."
    ],
    Informacoes_incorretas: [
        "Disseminação de dados ambientais sem fonte confiável.",
        "Distorção de fatos sobre temas sustentáveis.",
        "Compartilhamento de dicas ou práticas prejudiciais ao meio ambiente."
    ],
    Discurso_de_odio: [
        "Comentários com preconceito racial, religioso, de gênero ou orientação sexual.",
        "Ofensas a minorias ou grupos sociais.",
        "Uso de termos discriminatórios ou incitação à violência."
    ],
    Assedio_ou_perseguicao: [
        "Ataques direcionados a um ou mais usuários.",
        "Envio repetido de mensagens indesejadas com teor ofensivo.",
        "Tentativas de intimidar ou humilhar alguém na plataforma."
    ],
    Incitacao_a_praticas_ilegais: [
        "Apologia ao crime ambiental (como desmatamento ou caça ilegal).",
        "Incentivo ao descumprimento de leis de proteção ambiental.",
        "Compartilhamento de conteúdo sobre atividades ilegais."
    ],
    Conteudo_improprio_ou_explicito: [
        "Imagens ou vídeos com nudez ou violência.",
        "Divulgação de material gráfico que fere a política da plataforma."
    ]
}

function updateTitulo(selectElement) {
    const form = selectElement.closest('.form_denuncia');
    const enviarDenuncia = form.querySelector(".enviar-denuncia");
    const titulo = selectElement.value;
    const motivoSelect = form.querySelector(".motivo-options");

    console.log("Título selecionado:", titulo);
    console.log("Existe no arrayMotivos?", arrayMotivos.hasOwnProperty(titulo));

    motivoSelect.innerHTML = '<option value="">--- Selecione ---</option>';

    enviarDenuncia.classList.add("disabled");

    // Preenche os motivos se um título válido foi selecionado
    if (titulo && arrayMotivos[titulo]) {
        arrayMotivos[titulo].forEach(function(op) {
            const option = document.createElement("option");
            option.value = op;
            option.text = op;
            motivoSelect.appendChild(option);
        });
    }
}

function updateMotivo(selectElement) {
    const form = selectElement.closest('.form_denuncia');
    const enviarDenuncia = form.querySelector(".enviar-denuncia");
    const titulo = form.querySelector(".titulo-options").value;
    const motivo = selectElement.value;

    if (titulo && motivo) {
        enviarDenuncia.classList.remove("disabled");
    } else {
        enviarDenuncia.classList.add("disabled");
    }
}

function confirmSendDenuncia(button) {
    const form = button.closest('.form_denuncia');
    const enviarDenuncia = button;

    if (enviarDenuncia.classList.contains("disabled")) {
        Swal.fire({
            title: "Selecione um motivo para a denúncia.",
            icon: "warning",
            draggable: true
        });
        return;
    }

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
            }).then(() => {
                form.submit();
            });
        }
    });
}

function toggleReact(btn) {
    const wrapper = btn.closest('.reaction-wrapper');
    const btnReactionToggle = wrapper.querySelector('.btn-reaction-toggle');
    const reactContainer = wrapper.querySelector('.react-container');
    btnReactionToggle.classList.toggle('active');
    reactContainer.classList.toggle('show');
    // Fecha ao clicar fora
    if (reactContainer.classList.contains('show')) {
        setTimeout(() => {
            document.addEventListener('click', closeOnClickOutside);
        }, 0);
        function closeOnClickOutside(e) {
            if (!wrapper.contains(e.target)) {
                btnReactionToggle.classList.remove('active');
                reactContainer.classList.remove('show');
                document.removeEventListener('click', closeOnClickOutside);
            }
        }
    }
}

function toggleComment(btn) {
    const wrapper = btn.closest('.comment-wrapper');
    const commentModalContent = wrapper.querySelector('.comment-modal-content');
    commentModalContent.classList.toggle('show');
    // Fecha ao clicar fora
    if (commentModalContent.classList.contains('show')) {
        setTimeout(() => {
            document.addEventListener('click', closeOnClickOutside);
        }, 0);
        function closeOnClickOutside(e) {
            if (!wrapper.contains(e.target)) {
                commentModalContent.classList.remove('show');
                document.removeEventListener('click', closeOnClickOutside);
            }
        }
    }
}

function closeCommentModal(e) {
    const commentModalContent = e.target.closest('.comment-modal-content');
    if (commentModalContent) {
        commentModalContent.classList.remove('show');
    }
}

function toggleCheckListModal(btn) {
    const checkListWrapper = btn.closest('.checkIn-wrapper');
    const checkListModal = checkListWrapper.querySelector('.checklist-modal-content');
    checkListModal.style.display = 'flex';
}

function closeCheckListModal(event) {
    const checkListModal = event.target.closest('.checklist-modal-content');
    if (checkListModal) {
        checkListModal.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.querySelector('.edit-btn');
    const editModal = document.getElementById('editModal');
    const bioForm = document.getElementById('bioForm');
    const cancelBtn = document.getElementById('cancelBtn');

    editBtn.addEventListener('click', function () {
        editModal.style.display = 'flex';
    });

    bioForm.addEventListener('submit', function (e) {

        const novaBiografia = document.getElementById('biografia').value;
        console.log('Nova biografia:', novaBiografia);

        editModal.style.display = 'none';
    });

    cancelBtn.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    editModal.addEventListener('click', function (e) {
        if (e.target === editModal) {
            editModal.style.display = 'none';
        }
    });
});

//Contador do numero de caracteres em biografia
document.getElementById('username').addEventListener('input', function () {
    const charCounterUsername = this.value.length;
    document.getElementById('charCounterUsername').textContent = charCounterUsername + '/30';
});

document.getElementById('biografia').addEventListener('input', function () {
    const charCount = this.value.length;
    document.getElementById('charCounter').textContent = charCount + '/250';
});



document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.querySelector('.edit-btn');
    const editModal = document.getElementById('editModal');
    const bioForm = document.getElementById('nameForm');
    const cancelBtn = document.getElementById('cancelBtn');

    editBtn.addEventListener('click', function () {
        editModal.style.display = 'flex';
    });

    bioForm.addEventListener('submit', function (e) {

        const novoNome = document.getElementById('nome').value;
        console.log('Novo nome:', novoNome);

        editModal.style.display = 'none';
    });

    cancelBtn.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    editModal.addEventListener('click', function (e) {
        if (e.target === editModal) {
            editModal.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.querySelector('.edit-btn');
    const editModal = document.getElementById('editModal');
    const picForm = document.getElementById('PicForm'); // Corrigido: 'PicForm' (com P maiúsculo)
    const cancelBtn = document.getElementById('cancelBtn');

    editBtn.addEventListener('click', function () {
        editModal.style.display = 'flex';
    });

    picForm.addEventListener('submit', function (e) {

        const inputFoto = document.getElementById('profilePic');
        const arquivoFoto = inputFoto.files[0]; 

        if (arquivoFoto) {
            console.log('Nome do arquivo:', arquivoFoto.name);
            console.log('Tipo do arquivo:', arquivoFoto.type);
            console.log('Tamanho (bytes):', arquivoFoto.size); 
            } else {
                console.log('Nenhum arquivo selecionado.');
            }

            editModal.style.display = 'none';
        });

        cancelBtn.addEventListener('click', function () {
            editModal.style.display = 'none';
        });

        editModal.addEventListener('click', function (e) {
            if (e.target === editModal) {
                editModal.style.display = 'none';
            }
        });
    });
