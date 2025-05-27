
document.getElementById('formPostOrg').addEventListener('submit', function(e) {
    if (selectedFiles.length > 5) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Limite excedido',
            text: 'Você só pode enviar no máximo 5 imagens!',
            confirmButtonColor: '#3085d6'
        });
    }

});

document.getElementById('formPostOrg').addEventListener('submit', function(e) {
    if (selectedFiles.length > 5) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Limite excedido',
            text: 'Você só pode enviar no máximo 5 imagens!',
            confirmButtonColor: '#3085d6'
        });
    }

});



document.getElementById('formPostOrg').addEventListener('submit', function(e) {
const titulo = document.getElementById('tituloOrg').value.trim();
const descricao = document.getElementById('descricaoOrg').value.trim();
const endereco = document.getElementById('endereco').value.trim();
const link = document.getElementById('link').value.trim();

const regexTitulo = /^.{2,50}$/;
const regexDescricao = /^.{2,250}$/;
const regexEndereco = /^.{2,50}$/;
const regexLink = /^.{2,250}$/;

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

if (!regexEndereco.test(endereco)) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        title: 'Erro no Endereço',
        text: 'O ENDEREÇO deve ter entre 2 e 50 caracteres.'
    });
    return;
}

if (!regexLink.test(link)) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        title: 'Erro no Link',
        text: 'O LINK deve ter entre 2 e 250 caracteres.'
    });
    return;
}

const inicioInput = document.getElementById('dataTimeInicio');
const fimInput = document.getElementById('dataTimeFim');

const inicio = new Date(inicioInput.value);
const fim = new Date(fimInput.value);
const agora = new Date();
const cincoMesesDepois = new Date();
cincoMesesDepois.setMonth(cincoMesesDepois.getMonth() + 5);

if (isNaN(inicio) || isNaN(fim)) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        title: 'Erro de Data',
        text: 'Preencha corretamente os campos de data e hora.'
    });
    return;
}

if (inicio < agora) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        title: 'Data Inválida',
        text: 'A data de início não pode estar no passado.'
    });
    return;
}

if (fim < inicio) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        title: 'Data Inválida',
        text: 'A data de fim não pode ser antes da data de início.'
    });
    return;
}

if (inicio > cincoMesesDepois || fim > cincoMesesDepois) {
    e.preventDefault();
    Swal.fire({
        icon: 'error',
        title: 'Data Muito Distante',
        text: 'As datas não podem ultrapassar 5 meses a partir de hoje.'
    });
    return;
}
});




