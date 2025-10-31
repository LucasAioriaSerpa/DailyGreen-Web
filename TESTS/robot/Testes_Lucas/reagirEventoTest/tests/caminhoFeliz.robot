
*** Settings ***
Resource    ../resources/CFResource.robot
Test Setup    Abrir o navegador
Test Teardown    Fechar o navegador

*** Test Cases ***
Reagir Evento TEST - Participante
    [Documentation]    Esse teste tem como objetivo realizar um cadastro do tipo participante no DailyGreen
    [Tags]    cadastro_participante
    Acessar a página inicial do DailyGreen
    Entrando na conta
    
