document.addEventListener("DOMContentLoaded", function() {
    var inputs = document.querySelectorAll('.currency-input'); // Seleciona todos os inputs com a classe 'currency-input'

    inputs.forEach(function(input) {
      input.addEventListener('input', function(e) {
        var valor = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
        var formato = (valor / 100).toLocaleString('pt-BR', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        });

        e.target.value = formato;
      });
    });
 });

 // Captura o envio do formulário com Fetch API
 document.getElementById('formInserir').addEventListener('submit', function(event) {
      event.preventDefault();

      // Cria um objeto FormData com os dados do formulário
      const formData = new FormData(this);
      // Envia a requisição usando Fetch API
      fetch(this.action, {
          method: 'POST',
          body: formData
      })
      .then(response => {
          if (!response.ok) {
              throw new Error('Ocorreu um erro ao salvar o produto.');
          }
          return response.json(); // Retorna os dados como JSON se a resposta for OK
      })
      .then(data => {
          // Processa os dados de resposta, se necessário
          console.log(data);

           // Fecha o modal usando Bootstrap
          closeModal();

          this.reset(); // Limpa o formulário após o envio bem-sucedido
      })
      .catch(error => {
          console.error('Erro:', error.message);
      });
  });

  function closeModal() {
    $('#modal').modal('hide');
  }