let mdy = document.querySelectorAll('#updateMonth, #updateDay, #updateYear')
let allError = false
let allInput = document.querySelectorAll('input[type=text]')

mdy.forEach((el) => {
    el.addEventListener('change', () => {
        let m = document.querySelector('#updateMonth').value
        let d = document.querySelector('#updateDay').value
        let y = document.querySelector('#updateYear').value
        document.querySelector('#updateAge').value = calculateAge(m, d, y)
    })
})

let addBday = document.querySelectorAll('#month, #day, #year')
addBday.forEach((el) => {
    el.addEventListener('change', () => {
        let m = document.querySelector('#month').value
        let d = document.querySelector('#day').value
        let y = document.querySelector('#year').value
        document.querySelector('#age').value = calculateAge(m, d, y)
    })
})

const calculateAge = (m, d, y) => {
    if (m !== 0 && d !== 0 && y !== 0) {
        let dob = `${m}/${d}/${y}`

        const today = new Date()
        const bdate = new Date(dob)

        let age = today.getFullYear() - bdate.getFullYear()
        let month = today.getMonth() - bdate.getMonth()

        if (month < 0 || (month === 0 && today.getDate() < bdate.getDate())) {
            return age - 1
        }
        return age
    }
}

$(document).ready(() => {
    $('.my-select').selectpicker()
})

//CATEGORY
const update_other_category = document.querySelector('#update_other_category') //checkbox
const update_other_cat = document.querySelector('#update_other_cat') //textfield

//CHAPTER
const update_other_chapter = document.querySelector('#update_other_chapter') //checkbox
const update_other_chap = document.querySelector('#update_other_chap') //textfield

//SUBSPECIALTY
const update_other_subspecialty = document.querySelector(
    '#update_other_subspecialty'
) //checkbox
const update_other_sub = document.querySelector('#update_other_sub') //textfield

//PRACTICE
const update_other_practice = document.querySelector('#update_other_practice') //checkbox
const update_other_practices = document.querySelector('#update_other_practices') //textfield

//SPECIAL TRAINING
//checkbox
const update_other_special_training = document.querySelector(
    '#update_other_special_training'
)
//textfield
const upOtherSpecialTraining = document.querySelector('#upOtherSpecialTraining')

//COUNCIL
//checkbox
const update_other_council = document.querySelector('#update_other_council')
//textfield
const updateOtherCouncil = document.querySelector('#updateOtherCouncil')

//COMMITTEE
//checkbox
const update_other_committee = document.querySelector('#update_other_committee')
//textfield
const updateOtherCommittee = document.querySelector('#updateOtherCommittee')

update_other_special_training.addEventListener('change', () => {
    return update_other_special_training.checked
        ? upOtherSpecialTraining.removeAttribute('disabled')
        : (upOtherSpecialTraining.disabled = true)
})

update_other_council.addEventListener('change', () => {
    return update_other_council.checked
        ? updateOtherCouncil.removeAttribute('disabled')
        : (updateOtherCouncil.disabled = true)
})

update_other_committee.addEventListener('change', () => {
    return update_other_committee.checked
        ? updateOtherCommittee.removeAttribute('disabled')
        : (updateOtherCommittee.disabled = true)
})

update_other_category.addEventListener('change', () => {
    return update_other_category.checked
        ? update_other_cat.removeAttribute('disabled')
        : (update_other_cat.disabled = true)
})

update_other_chapter.addEventListener('change', () => {
    return update_other_chapter.checked
        ? update_other_chap.removeAttribute('disabled')
        : (update_other_chap.disabled = true)
})

update_other_subspecialty.addEventListener('change', () => {
    return update_other_subspecialty.checked
        ? update_other_sub.removeAttribute('disabled')
        : (update_other_sub.disabled = true)
})

update_other_practice.addEventListener('change', () => {
    return update_other_practice.checked
        ? update_other_practices.removeAttribute('disabled')
        : (update_other_practices.disabled = true)
})

const update_imgPreview = document.querySelector('#update_imgPreview')
const update_imgUpload = document.querySelector('#update_imageUpload')
update_imgPreview.addEventListener('click', () => {
    update_imgUpload.click()
})

update_imgUpload.addEventListener('change', (e) => {
    // console.log(e.target.files[0])
    if (e.target.files[0]) {
        const reader = new FileReader()
        reader.onload = (e) => {
            update_imgPreview.setAttribute('src', e.target.result)
        }
        reader.readAsDataURL(e.target.files[0])
    }
    update_imgUpload.setAttribute('src', e.target.result)
})
