
*** Settings ***
Resource    ../resources/CFResource.robot
Test Setup    abrir o navegador
Test Teardown    fechar o navegador

*** Test Cases ***
Cadastro Participante TEST - DailyGreen
    [Documentation]    Esse teste tem como objetivo realizar um cadastro do tipo participante no DailyGreen
    [Tags]    cadastro_participante
    Acessar a página inicial do DailyGreen
    Preencher formulário de cadastro - Parte 1
    Preencher formulário de cadastro - Parte 2
    Preencher formulário de cadastro - Parte 3
    Validar sucesso de cadastro
