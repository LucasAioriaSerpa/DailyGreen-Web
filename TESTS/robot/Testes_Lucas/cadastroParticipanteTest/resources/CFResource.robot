
*** Settings ***
Library    SeleniumLibrary
Library    PYTHON/utils.py

*** Variables ***
${BROWSER}    chrome
${URL}    http://localhost/DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php
${BTN_CADASTRO}    name=btn-cadastro
${INPUT_NOME}    id=nome
${VALUE_NOME}    Nome
${INPUT_EMAIL}    id=email
${VALUE_EMAIL}    email@gmail.com
${INPUT_RAD_PAR}    id=radPar
${INPUT_FILE_PROFILE_PIC}    id=file
${FILE_PROFILE_PIC}    ../resources/IMG/profile_picture.jpg
${INPUT_GENERO}    id=genero
${OPTION_GENERO}    Masculino
${INPUT_SENHA}    id=senha
${SENHA}    senha@forte123456789
${INPUT_CONFIRMAR_SENHA}    id=senha_confirm
${BTN_PROXIMO}    id=submit
${BTN_CADASTRAR}    id=cadastrar

*** Keywords ***
Abrir o navegador
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

Acessar a página inicial do DailyGreen
    Wait Until Element Is Visible    ${BTN_CADASTRO}    10s
    Capture Page Screenshot
    Click Element    ${BTN_CADASTRO}

Preencher formulário de cadastro - Parte 1
    Wait Until Element Is Visible    ${INPUT_NOME}    10s
    Input Text    ${INPUT_NOME}    ${VALUE_NOME}
    Capture Page Screenshot
    Input Text    ${INPUT_EMAIL}    ${VALUE_EMAIL}
    Capture Page Screenshot
    Click Element    ${INPUT_RAD_PAR}
    Capture Page Screenshot
    Click Element    ${BTN_PROXIMO}

Preencher formulário de cadastro - Parte 2
    ${FILE_PROFILE_PIC} =    Absolute_path    ${FILE_PROFILE_PIC}
    Wait Until Element Is Visible    ${INPUT_FILE_PROFILE_PIC}    10s
    Capture Page Screenshot
    Choose File    ${INPUT_FILE_PROFILE_PIC}    ${FILE_PROFILE_PIC}
    Capture Page Screenshot
    Select From List By Label    ${INPUT_GENERO}    ${OPTION_GENERO}
    Capture Page Screenshot
    Click Element    ${BTN_PROXIMO}

Preencher formulário de cadastro - Parte 3
    Wait Until Element Is Visible    ${INPUT_SENHA}    10s
    Capture Page Screenshot
    Input Text    ${INPUT_SENHA}    ${SENHA}
    Capture Page Screenshot
    Input Text    ${INPUT_CONFIRMAR_SENHA}    ${SENHA}
    Capture Page Screenshot
    Click Element    ${BTN_CADASTRAR}

Validar sucesso de cadastro
    Wait Until Page Contains Element    id=btn-entrar    timeout=10s

Fechar o navegador
    Run Keyword If    '${TEST STATUS}' == 'FAIL'    Capture Page Screenshot
    Close Browser