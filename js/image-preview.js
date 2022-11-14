const userImage = document.getElementById('user_image')
const imagePreview = document.getElementById('image_preview')

imagePreview.addEventListener('click', () => {
    userImage.click()
})

userImage.addEventListener('change', (e) => {
    if (e.target.files[0]) {
        const reader = new FileReader()
        reader.onload = (e) => {
            imagePreview.setAttribute('src', e.target.result)
        }
        reader.readAsDataURL(e.target.files[0])
    }
    userImage.setAttribute('src', e.target.result)
})
