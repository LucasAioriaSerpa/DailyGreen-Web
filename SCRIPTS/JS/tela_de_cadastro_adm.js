let senha = document.getElementById('input_senha_adm');
let confirmarSenha = document.getElementById('input_confirmacao_senha');

function redirecionarAdm(){
    document.getElementById('form_cadastro').addEventListener("submit", function(chamarFuncaoCadastroAdm){
        chamarFuncaoCadastroAdm.preventDefault();
        alert('Usuário cadastrado com sucesso!');
        window.location.href = "/DailyGreen-Project/SCRIPTS/HTML/pagina_login_administrador.html";
    });
}

function validarSenhas(){
    if (senha === confirmarSenha){
        redirecionarAdm();
    } else {
        alert('As senhas estão diferentes!');
    }
}