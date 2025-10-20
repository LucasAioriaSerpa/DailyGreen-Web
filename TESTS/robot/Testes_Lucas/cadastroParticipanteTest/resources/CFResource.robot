
*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${BROWSER}    Chrome
${URL}    https://http://localhost/DailyGreen-Project/SCRIPTS/PHP/main-page.php


*** Keywords ***
abrir o navegador
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

acessar a pagina home do DailyGreen

fechar o navegador
    Capture Page Screenshot
    Close Browser
