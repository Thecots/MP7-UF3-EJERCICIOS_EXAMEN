const comprar = document.querySelector('#comprar'),
  vender = document.querySelector('#vender');

document.querySelector('form').addEventListener('submit', e => {
  e.preventDefault();
})

const formatYmd = date => date.slice(0, 10);

console.log();

comprar.addEventListener('click', () => {
  x = check();
  if (x) {
    $.ajax({
      url: 'comprar.php',
      method: 'POST',
      data: {
        accio: x[0],
        data: x[1],
        quantiat: x[2],
        preu: x[3],
      },
      success: function (r) {
        if (r == 'ok') {
          window.location.reload();
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error en el servidor',
          })
        }
      },
    });
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Campos vacíos',
    })
  }
});


vender.addEventListener('click', () => {
  x = check();
  if (x) {
    $.ajax({
      url: 'vender.php',
      method: 'POST',
      data: {
        accio: x[0],
        data: x[1],
        quantiat: x[2],
        preu: x[3],
      },
      success: function (r) {
        if (r == 'ok') {
          window.location.reload();
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "No disposes d'aquesta quantitat",
          })
        }
      },
    });
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Campos vacíos',
    })
  }
});

function check() {
  let accio = document.querySelector('form')[0].value,
    data = document.querySelector('form')[1].value,
    quantitat = document.querySelector('form')[2].value,
    preu = document.querySelector('form')[3].value;
  if (accio == '' || data == '' || quantitat == '' || preu == '') {
    return false;
  }

  let date = new Date();


  data = formatYmd('2022-02-16') + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
  console.log(data);
  return [accio, data, quantitat, preu];
}