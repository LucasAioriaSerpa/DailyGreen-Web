// BOTÃO LOGOUT
function btnLogout(){
    window.location.href = '/Dailygreen-Project/SCRIPTS/HTML/tela_de_login_adm.html';
}

// TITULO - DAILYGREEN
const word = 'DAILYGREEN';
const title = document.getElementById('title');

function createLetters(){
    title.innerHTML = '';
    for (let i = 0; i < word.length; i++){
        const span = document.createElement('span');
        span.textContent = word[i];
        span.classList.add('letter');
        title.appendChild(span);
    }
}

function animationIn(){
    const letters = document.querySelectorAll('.letter');
    letters.forEach((letter, index) => {
        setTimeout(() => {
            letter.classList.add('visible');
        }, index * 800);
    })

    setTimeout(animationOut, word.length * 800 + 800);
}

function animationOut(){
    const letters = document.querySelectorAll('.letter');
    letters.forEach((letter, index) => {
        setTimeout(() => {
            letter.classList.remove('visible');
            letter.classList.add('out');
        }, index * 200);
    })

    setTimeout(() => {
        createLetters();
        animationIn();
    }, word.length * 200 + 800);
}

createLetters();
setTimeout(animationIn, 1000);
