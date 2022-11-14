const form = document.querySelector('form')
console.log(form)
form.addEventListener('submit', (e) => {
    if (!form.checkValidity()) {
        e.preventDefault()
    }
    form.classList.add('was-validated')
})
