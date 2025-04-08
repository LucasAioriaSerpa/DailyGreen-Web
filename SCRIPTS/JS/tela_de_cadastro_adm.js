const senha = document.getElementById('input_senha_adm');
const confirmarSenha = document.getElementById('input_confirmacao_senha');

function redirecionarAdm(){
alert('Usuário cadastrado com sucesso!');
window.location.href = "/DailyGreen-Project/SCRIPTS/HTML/pagina_login_administrador.html";
}

document.getElementById('form_cadastro').addEventListener("submit", function(chamarFuncaoCadastroAdm){
chamarFuncaoCadastroAdm.preventDefault();
if (senha.value === confirmarSenha.value){
    redirecionarAdm();
} else {
    alert('As senhas estão diferentes!');
}});