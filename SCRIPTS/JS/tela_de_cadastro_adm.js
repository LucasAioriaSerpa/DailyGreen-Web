document.addEventListener("DOMContentLoaded", function () {

    // FUNÇÃO PARA VALIDAR SE OS CAMPOS DE SENHA SÃO IGUAIS

    const senha = document.getElementById('password');
    const confirmacaoSenha = document.getElementById('input_confirmacao_password');
    const statusSenha = document.getElementById('status_password');
    const statusConfirmacao = document.getElementById('status_confirmacao_password');
  

    function verificarSenha() {
      if (senha.value === confirmacaoSenha.value) {
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
  
    // FUNÇÃO PARA VALIDAR SE O EMAIL ESTÁ CORRETO

    window.validarEmail = function () {
      const email = document.getElementById("email").value.trim();
      const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  
      switch (true) {
        case (email === ""):
          Swal.fire({
            icon: 'warning',
            title: 'Campo vazio',
            text: 'O campo de e-mail está vazio.'
          });
          return false;
  
        case (!regexEmail.test(email)):
          Swal.fire({
            icon: 'error',
            title: 'E-mail inválido',
            text: 'Digite um e-mail válido.'
          });
          return false;
  
        default:
          return true; 
      }
    };
  }
);