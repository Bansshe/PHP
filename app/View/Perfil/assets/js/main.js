const cpfMask = document.getElementById('cpfInput');

cpfInput.addEventListener('input', function(e) {
  let cpf = e.target.value.replace(/\D/g, '');

  if (cpf.length > 11) {
    cpf = cpf.slice(0, 11);
  }

  cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');

  e.target.value = cpf;
});

const telefoneInput = document.getElementById('telefoneInput');

telefoneInput.addEventListener('input', function(e) {
  let telefone = e.target.value.replace(/\D/g, '');

  if (telefone.length > 11) {
    telefone = telefone.slice(0, 11);
  }

  if (telefone.length > 2 && telefone.length <= 6) {
    telefone = telefone.replace(/(\d{2})(\d{1,4})/, '($1) $2');
  } else if (telefone.length >= 7) {
    telefone = telefone.replace(/(\d{2})(\d{1,5})(\d{1,4})/, '($1) $2-$3');
  }

  e.target.value = telefone;
});

const cepInput = document.getElementById('cepInput');

cepInput.addEventListener('input', function(e) {
  let cep = e.target.value.replace(/\D/g, '');

  if (cep.length > 8) {
    cep = cep.slice(0, 8);
  }

  cep = cep.replace(/(\d{5})(\d{3})/, '$1-$2');

  e.target.value = cep;
});

const numberValInput = document.getElementById('numberVal');

numberValInput.addEventListener('keydown', function(event) {
    const key = event.key;
    
    if (!/^\d+$/.test(key) && key !== 'Backspace' && key !== 'Delete' && key !== 'ArrowLeft' && key !== 'ArrowRight') {
        event.preventDefault();
    }
});

const paisVal = document.getElementById('paisVal');

paisVal.addEventListener('input', function(e) {
  let inputValue = e.target.value;

  inputValue = inputValue.replace(/\d/g, '');

  e.target.value = inputValue;
});

const ufVal = document.getElementById('ufVal');

ufVal.addEventListener('input', function(e) {
  let inputValue = e.target.value;

  inputValue = inputValue.replace(/\d/g, '');

  e.target.value = inputValue;
});

const cidadeVal = document.getElementById('cidadeVal');

cidadeVal.addEventListener('input', function(e) {
  let inputValue = e.target.value;

  inputValue = inputValue.replace(/\d/g, '');

  e.target.value = inputValue;
});