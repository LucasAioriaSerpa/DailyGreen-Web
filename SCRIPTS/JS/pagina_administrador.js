// BOTÃO LOGOUT
function btnLogout(){
    window.location.href = '/Dailygreen-Project/SCRIPTS/PHP/LOGIC/logout-adm.php';
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

// BOTÕES SIDEBAR ESQUERDA
function loadPage(page) {
    fetch(page)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar a página');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('menu_principal').innerHTML = data;
        })
        .catch(error => {
            console.error('Erro:', error);
            document.getElementById('menu_principal').innerHTML = '<p>Erro ao carregar o conteúdo.</p>';
        });
}

function showButtons(){
    const btnShowList = document.getElementById('menu_navegacao');
    btnShowList.style.display = btnShowList.style.display === 'flex' ? 'none' : 'flex';
}