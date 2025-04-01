//? Toggle hide and show password input
function togglePasswordInput() {
    const pwInput = document.getElementById('password');
    if (pwInput.type === "password") {
        pwInput.type = "text";
    } else {
        pwInput.type = "password";
    }
}
//? consts variables data-inputs
const servername = document.getElementById('servername')
const username = document.getElementById('username')
const port = document.getElementById('port')
//? REGEXP validations
function checkSN(servername) {
    const re = /^[^\d][^\s][\w]+$/
    return re.test(servername)
}
function checkUN(username) {
    const re = /^[^\d][^\s][\w]+$/
    return re.test(username)
}
function checkPR(port) {
    const re = /^\d{4}$/
    return re.test(port)
}
//? indicator listeners
servername.addEventListener('input', () => {
    if (!checkSN(servername.value || !(username.value === ''))) {
        servername.style.color = "#ff0000"
    } else {
        servername.style.color = "#121212"
    }
})
username.addEventListener('input', () => {
    if (!checkUN(username.value)) {
        username.style.color = "#ff0000"
    } else {
        username.style.color = "#121212"
    }
})
port.addEventListener('input', () => {
    if (!checkPR(port.value)) {
        port.style.color = "#ff0000"
    } else {
        port.style.color = "#121212"
    }
})