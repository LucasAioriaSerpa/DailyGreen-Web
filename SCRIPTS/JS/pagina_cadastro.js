
const form = document.getElementById('form_cadastro');
const senha = document.getElementById('senha');
const confirmacaoSenha = document.getElementById('senha_confirm');
const statusSenha = document.getElementById('status_password');
const statusConfirmacao = document.getElementById('status_senha_confirm');

// Atualiza ícones em tempo real
function atualizarStatusSenhas() {
  if (senha.value === confirmacaoSenha.value && senha.value !== "") {
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


form.addEventListener('submit', function (event) {
  if (senha.value !== confirmacaoSenha.value) {
    event.preventDefault(); 

    Swal.fire({
      icon: 'warning',
      title: 'Senhas diferentes',
      text: 'As senhas não coincidem. Verifique e tente novamente.',
    });
  }
});

senha.addEventListener("input", atualizarStatusSenhas);
confirmacaoSenha.addEventListener("input", atualizarStatusSenhas);  
