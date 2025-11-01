
*** Settings ***
Resource    ../resources/CFResource.robot
Test Setup    Abrir o navegador
Test Teardown    Fechar o navegador

*** Test Cases ***
Comentar Postagem TEST - Participante
    [Documentation]    Esse teste tem como objetivo realizar comentar em uma postagem no DailyGreen
    [Tags]    comentar_postagem
    Acessar a página inicial do DailyGreen
    Entrando na conta
    Abrir comentario
    Preencher comentario
