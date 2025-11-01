
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
${BTN_COMMENT}    id=btnComment
${INPUT_COMMENT_TITLE}    id=comment_title
${VALUE_COMMENT_TITLE}    titulo comentario
${INPUT_COMMENT_TEXT}    id=comment_text
${VALUE_COMMENT_TEXT}    texto do comentario
${BTN_COMMENT_POST}    name=comment-post

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

Abrir comentario
    Wait Until Element Is Visible    ${BTN_COMMENT}    10s
    Capture Page Screenshot
    Click Element    ${BTN_COMMENT}

Preencher comentario
    Wait Until Element Is Visible    ${INPUT_COMMENT_TEXT}    10s
    Capture Page Screenshot
    Input Text    ${INPUT_COMMENT_TITLE}    ${VALUE_COMMENT_TITLE}
    Capture Page Screenshot
    Input Text    ${INPUT_COMMENT_TEXT}    ${VALUE_COMMENT_TEXT}
    Capture Page Screenshot
    Click Element    ${BTN_COMMENT_POST}

Fechar o navegador
    Run Keyword If    '${TEST STATUS}' == 'FAIL'    Capture Page Screenshot
    Close Browser
