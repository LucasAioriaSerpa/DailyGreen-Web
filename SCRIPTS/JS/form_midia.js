let selectedFiles = [];

function loadFiles(event) {
    const files = Array.from(event.target.files);
    selectedFiles = files;
    renderPreview();
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    // Update the file input with the remaining files
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    document.getElementById('insert_media').files = dataTransfer.files;
    renderPreview();
}

function renderPreview() {
    const previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = '';
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            let element;
            if (file.type.startsWith('image/')) {
                element = document.createElement('img');
                element.src = e.target.result;
                element.className = 'preview-media-img';
            }
            if (element) {
                const wrapper = document.createElement('div');
                wrapper.className = 'preview-media-wrapper';
                wrapper.appendChild(element);

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.textContent = '×';
                removeBtn.className = 'preview-media-remove-btn';
                removeBtn.onclick = () => removeFile(index);

                wrapper.appendChild(removeBtn);
                previewContainer.appendChild(wrapper);
            }
        };
        reader.readAsDataURL(file);
    });
}

document.getElementById('formPost').addEventListener('submit', function(e) {
const titulo = document.getElementById('titulo').value.trim();
const descricao = document.getElementById('descricao').value.trim();

const regexTitulo = /^.{2,50}$/;
const regexDescricao = /^.{2,250}$/;

if (!regexTitulo.test(titulo)) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        title: 'Erro no Título',
        text: 'O TÍTULO deve ter entre 2 e 50 caracteres.'
    });
    return;
}

if (!regexDescricao.test(descricao)) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        title: 'Erro na Descrição',
        text: 'A DESCRIÇÃO deve ter entre 2 e 250 caracteres.'
    });
    return;
}
});











































