*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${BROWSER}    chrome
${URL}    http://localhost/DailyGreen-Project/SCRIPTS/PHP/loginAdm.php
${INPUT_LOGIN_EMAIL}    id=email
${VALUE_EMAIL}    lucasaioriaserpa@outlook.com
${INPUT_LOGIN_PASSWORD}    id=senha
${VALUE_PASSWORD}    123456789
${BTN_ENTRAR}    id=botaoLogar
${BTN_LIST_DENUNCIA}    id=btn-report-list
${BTN_ANALISE}    id=btn-analyse
${BTN_BAN}    id=ban
${INPUT_SELECT_MOTIVO}    id=motivo-ban
${OPTION_MOTIVO}    Publicacao_de_conteudo_improprio_ou_explicito
${BTN_BANIR_USUARIO}    id=banir_usuario

*** Keywords ***
Abrir o navegador
    Open Browser    ${URL}    ${BROWSER}
    Capture Page Screenshot
    Maximize Browser Window

Acessar a página administrador do DailyGreen
    Wait Until Element Is Visible    ${INPUT_LOGIN_EMAIL}    10s
    Capture Page Screenshot
    Input Text    ${INPUT_LOGIN_EMAIL}    ${VALUE_EMAIL}
    Capture Page Screenshot
    Input Text    ${INPUT_LOGIN_PASSWORD}    ${VALUE_PASSWORD}
    Capture Page Screenshot
    Click Element    ${BTN_ENTRAR}

Acessar a lista de denuncias
    Wait Until Element Is Visible    ${BTN_LIST_DENUNCIA}    10s
    Capture Page Screenshot
    Click Element    ${BTN_LIST_DENUNCIA}

Analisar a denuncia
    Wait Until Element Is Visible    ${BTN_ANALISE}    10s
    Capture Page Screenshot
    Click Element    ${BTN_ANALISE}

Banir usuario
    Wait Until Element Is Visible    ${BTN_BAN}    10s
    Capture Page Screenshot
    Click Element    ${BTN_BAN}
    Wait Until Element Is Visible    ${BTN_BANIR_USUARIO}    10s
    Capture Page Screenshot
    Select From List By Value    ${INPUT_SELECT_MOTIVO}    ${OPTION_MOTIVO}
    Capture Page Screenshot
    Click Element    ${BTN_BANIR_USUARIO}

Fechar o navegador
    Run Keyword If    '${TEST STATUS}' == 'FAIL'    Capture Page Screenshot
    Close Browser
