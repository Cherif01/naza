// script.js

document.addEventListener('DOMContentLoaded', event => {
  // Exemple d'utilisation de Toastr
  toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    preventDuplicates: false,
    onclick: null,
    showDuration: '300',
    hideDuration: '1000',
    timeOut: '5000',
    extendedTimeOut: '1000',
    showEasing: 'swing',
    hideEasing: 'linear',
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut'
  }

  // Recupere la list et le form (div) du transfert
  let listTransfert = document.getElementById('myTable')
  let formTransfert = document.getElementById('form-transfert')

  let blueBtn = document.getElementById('blueBtn')
  let redBtn = document.getElementById('redBtn')

  formTransfert.classList.add('d-none')
  redBtn.classList.add('d-none')

  // event show form
  blueBtn.addEventListener('click', () => {
    listTransfert.classList.add('d-none')
    blueBtn.classList.add('d-none')

    formTransfert.classList.remove('d-none')
    redBtn.classList.remove('d-none')
  })
  // Event hide form
  redBtn.addEventListener('click', () => {
    listTransfert.classList.remove('d-none')
    blueBtn.classList.remove('d-none')

    formTransfert.classList.add('d-none')
    redBtn.classList.add('d-none')
  })

  // End controle transfert
})
