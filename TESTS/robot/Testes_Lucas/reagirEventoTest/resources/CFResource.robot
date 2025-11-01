
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
${BTN_REACTION}    id=btn-reaction-Nome
${BTN_REACTION_GOSTEI}    name=reaction-gostei
${BTN_REACTION_NUM}    class=reaction-num

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
    Capture Page Screenshot
    Input Text    ${INPUT_LOGIN_EMAIL}    ${VALUE_EMAIL}
    Capture Page Screenshot
    Input Text    ${INPUT_LOGIN_PASSWORD}    ${VALUE_PASSWORD}
    Capture Page Screenshot
    Click Element    ${BTN_ENTRAR}

Abrir reações
    Wait Until Element Is Visible    ${BTN_REACTION}    10s
    Capture Page Screenshot
    Click Element    ${BTN_REACTION}

Apertar na reacao de gostei
    Wait Until Element Is Visible    ${BTN_REACTION_GOSTEI}    10s
    Capture Page Screenshot
    Click Element    ${BTN_REACTION_GOSTEI}

Fechar o navegador
    Run Keyword If    '${TEST STATUS}' == 'FAIL'    Capture Page Screenshot
    Close Browser
