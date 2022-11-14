/**
 * month
 * day
 * year
 * age
 */
let mdy = document.querySelectorAll('#month, #day, #year')

mdy.forEach((el) => {
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
        const birthDate = new Date(dob)

        let age = today.getFullYear() - birthDate.getFullYear()
        let month = today.getMonth() - birthDate.getMonth()

        if (
            month < 0 ||
            (month === 0 && today.getDate() < birthDate.getDate())
        ) {
            return age - 1
        }
        return age
    }
}
