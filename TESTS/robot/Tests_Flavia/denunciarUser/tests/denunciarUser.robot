*** Settings ***
Library    SeleniumLibrary
Resource    ../resources/keywords.robot
Resource    ../../publicarEvento/resources/keywords.robot

*** Test Cases ***
Denunciar
    Abrir Site na Página Principal
    Fazer Login Participante
    Denunciar Usuário
    Verificar Denuncia
    Fechar Browser
