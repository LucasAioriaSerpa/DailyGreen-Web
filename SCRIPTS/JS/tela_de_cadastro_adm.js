// const senha = document.getElementById('password');
// const confirmarSenha = document.getElementById('input_confirmacao_password');

// function redirecionarAdm(){
//     alert('Usuário cadastrado com sucesso!');
//     window.location.href = '/DailyGreen-Project/SCRIPTS/PHP/LOGIC/savePartsJSONCadastroAdm.php';
// }

// document.getElementById('form_cadastro').addEventListener("submit", function(chamarFuncaoCadastroAdm){
//     chamarFuncaoCadastroAdm.preventDefault();
//     if (senha.value === confirmarSenha.value){
//         redirecionarAdm();
//     } else {
//         alert('As senhas estão diferentes!');
//     }});

const senha = document.getElementById('password');
const confirmacaoSenha = document.getElementById('input_confirmacao_password');
const statusSenha = document.getElementById('status_password');
const statusConfirmacao = document.getElementById('status_confirmacao_password');

function verificarSenha(){
    if (senha.value === confirmacaoSenha.value){
        statusSenha.textContent = "✔️";
        statusSenha.className = "check";
        statusConfirmacao.textContent = "✔️";
        statusConfirmacao.className = "check";
      } else {
        statusSenha.textContent = "❌";
        statusSenha.className = "error";
        statusConfirmacao.textContent = "❌";
        statusConfirmacao.className = "error";
      }
    }

senha.addEventListener("input", verificarSenha);
confirmacaoSenha.addEventListener("input", verificarSenha);