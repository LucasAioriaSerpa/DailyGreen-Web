
*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${BROWSER}    chrome
${URL}    http://localhost/DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php
${BTN_lOGIN}    name=btn-login
${INPUT_LOGIN_EMAIL}    id=email
${VALUE_EMAIL}    email@gmail.com
${INPUT_LOGIN_PASSWORD}    id=password
${VALUE_PASSWORD}    senha@forte123456789
${BTN_ENTRAR}    id=btn-entrar
${INPUT_TITULO}    id=titulo

*** Keywords ***

Abrir o navegador
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

Acessar a página inicial do DailyGreen
    Wait Until Element Is Visible    ${BTN_LOGIN}    10s
    Capture Page Screenshot
    Click Element    ${BTN_lOGIN}

Entrando na conta
    

Fechar o navegador
    Run Keyword If    '${TEST STATUS}' == 'FAIL'    Capture Page Screenshot
    Close Browser
