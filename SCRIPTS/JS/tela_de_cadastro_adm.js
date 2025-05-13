
// FUNÇÃO PARA VALIDAR SE OS CAMPOS DE SENHA SÃO IGUAIS

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

// FUNÇÃO PARA VALIDAR SE O EMAIL É VALIDO → REGEX

const forms_cadastro = document.getElementById('form_cadastro');
forms_cadastro.addEventListener("submit", function(validarEmail){
    const emailInput = document.getElementById('email');
    const email = emailInput.value;
    const regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

    if (!regex.test(email)){
        validarEmail.preventDefault();
        Swal.fire({
            title: "Erro!",
            text: "Email incorreto, favor verificar!",
            icon: "error"
        });
        emailInput.focus();
    } else if (senha.value != confirmacaoSenha.value){
        validarEmail.preventDefault()
        Swal.fire({
            title: "Erro!",
            text: "As senhas estão diferentes, favor verificar!",
            icon: "error"
        });
    }
})
