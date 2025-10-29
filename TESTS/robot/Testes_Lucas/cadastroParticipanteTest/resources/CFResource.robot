
*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${BROWSER}    Chrome
${URL}    http://localhost/DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php
${btn-cadastro}    name=btn-cadastro
${URL-cadastro-pt1}    http://localhost/DailyGreen-Project/SCRIPTS/PHP/accountCreation.php
${input-email}    id=email
${input-senha}    id=password
${email}    lucasaioriaserpa@hotmail.com
${senha}    senha@forte123456789


*** Keywords ***
abrir o navegador
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

acessar a pagina home do DailyGreen


fechar o navegador
    Capture Page Screenshot
    Close Browser
