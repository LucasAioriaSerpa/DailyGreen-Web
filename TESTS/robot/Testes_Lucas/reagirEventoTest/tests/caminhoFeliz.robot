
*** Settings ***
Resource    ../resources/CFResource.robot
Test Setup    Abrir o navegador
Test Teardown    Fechar o navegador

*** Test Cases ***
Reagir Evento TEST - Participante
    [Documentation]    Esse teste tem como objetivo reagir a um evento no DailyGreen
    [Tags]    Reagir_Evento
    Acessar a página inicial do DailyGreen
    Entrando na conta
    Abrir reações
    Apertar na reacao de gostei
