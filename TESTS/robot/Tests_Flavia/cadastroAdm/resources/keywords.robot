*** Settings ***
Library    SeleniumLibrary
Resource    variables.robot

*** Keywords ***
Abrir Site Login Adm
    [Documentation]    Abre o site DailyGreen no link do perfil do Administrador
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

Cadastrar Administrador
    [Documentation]    Cadastra um email válido, cadastra uma senha, e insere a mesma senha cadastrada para confirmação da senha. E verifica se redirecionou para a página de Login, analisando se existe o elemento 'H2' com o texto 'LOGIN'.
    [Arguments]     ${email}    ${senha}    ${confirmacao_senha}
    Input Text    ${CAMPO_EMAIL}    ${email}
    Input Password    ${CAMPO_SENHA}    ${senha}
    Input Password    ${CAMPO_CONFIRMAR_SENHA}    ${confirmacao_senha}
    Click Button    ${BOTAO_CADASTRAR}
    Wait Until Page Contains Element    //h2[normalize-space()='LOGIN']    timeout=2s

Fechar Navegador
    [Documentation]    Espera 5 minutos e fecha o navegador
    Sleep    5
    Close Browser

    