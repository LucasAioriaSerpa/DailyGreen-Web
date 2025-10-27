*** Settings ***
Library    SeleniumLibrary
Resource    ../resources/keywords.robot

*** Test Cases ***
Cadastro Administrador
    Abrir Site Login Adm
    Cadastrar Administrador    ${EMAIL_VALIDO}    ${SENHA}    ${SENHA_CONFIRMADA}
    Fechar Navegador
