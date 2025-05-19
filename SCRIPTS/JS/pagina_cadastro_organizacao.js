document.getElementById('form-cadastro').addEventListener('submit', function (e) {
    const cnpjInput = document.getElementById('cnpj').value.trim();
    const cnpjRegex = /^(\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}|\d{14})$/;

    if (cnpjInput && !cnpjRegex.test(cnpjInput)) {
      e.preventDefault();

      Swal.fire({
        icon: 'error',
        title: 'CNPJ inválido',
        text: 'Use o formato 00.000.000/0000-00 ou apenas 14 dígitos numéricos.',
        confirmButtonColor: '#3085d6'
      });
    }
  });