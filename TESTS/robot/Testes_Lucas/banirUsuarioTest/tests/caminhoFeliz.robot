*** Settings ***
Resource    ../resources/CFResource.robot
Test Setup    Abrir o navegador
Test Teardown    Fechar o navegador

*** Test Cases ***
Banir Usuario TEST - Administrador
    [Documentation]    Esse teste tem como objetivo banir um usuario no Dailygreen
    [Tags]    Banir_Usuario
    Acessar a página administrador do DailyGreen
    Acessar a lista de denuncias
    Analisar a denuncia
    Banir usuario
