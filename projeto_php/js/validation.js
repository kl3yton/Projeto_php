// Exemplo de JavaScript para desabilitar o envio de formulários se houver campos inválidos
(() => {
  'use strict' // Ativa o modo estrito do JavaScript, prevenindo erros comuns

  // Seleciona todos os formulários que possuem a classe 'needs-validation' (necessitam de validação personalizada)
  const forms = document.querySelectorAll('.needs-validation')

  // Itera sobre todos os formulários selecionados
  Array.from(forms).forEach(form => {
      // Adiciona um ouvinte de evento para o evento de 'submit' (envio) do formulário
      form.addEventListener('submit', event => {
          // Verifica se o formulário é válido (se todos os campos obrigatórios foram preenchidos corretamente)
          if (!form.checkValidity()) {
              // Se o formulário não for válido, previne o envio do formulário
              event.preventDefault()
              // Impede que o evento continue propagando
              event.stopPropagation()
          }

          // Adiciona a classe 'was-validated' ao formulário, ativando os estilos de validação do Bootstrap
          form.classList.add('was-validated')
      }, false) // Define a captura do evento como falsa (não captura em fases anteriores do evento)
  })
})()
