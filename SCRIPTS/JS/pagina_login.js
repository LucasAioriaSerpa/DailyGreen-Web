document.addEventListener("DOMContentLoaded", function () {

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




})