
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
${VALUE_TITULO}    titulo postagem
${INPUT_DESCRICAO}    id=descricao
${VALUE_DESCRICAO}    descrição postagem
${BTN_POSTAR}    id=btn-postar

*** Keywords ***

Abrir o navegador
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

Acessar a página inicial do DailyGreen
    Wait Until Element Is Visible    ${BTN_LOGIN}    10s
    Capture Page Screenshot
    Click Element    ${BTN_lOGIN}

Entrando na conta
    Wait Until Element Is Visible    ${INPUT_LOGIN_EMAIL}    10s
    Input Text    ${INPUT_LOGIN_EMAIL}    ${VALUE_EMAIL}
    Capture Page Screenshot
    Input Text    ${INPUT_LOGIN_PASSWORD}    ${VALUE_PASSWORD}
    Capture Page Screenshot
    Click Element    ${BTN_ENTRAR}

Preenchendo post
    Wait Until Element Is Visible    ${INPUT_TITULO}    10s
    Input Text    ${INPUT_TITULO}    ${VALUE_TITULO}
    Capture Page Screenshot
    Input Text    ${INPUT_DESCRICAO}    ${VALUE_DESCRICAO}
    Capture Page Screenshot
    Click Element    ${BTN_POSTAR}

Fechar o navegador
    Run Keyword If    '${TEST STATUS}' == 'FAIL'    Capture Page Screenshot
    Close Browser
