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
            } else if (file.type.startsWith('video/')) {
                element = document.createElement('video');
                element.src = e.target.result;
                element.controls = true;
                element.className = 'preview-media-video';
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