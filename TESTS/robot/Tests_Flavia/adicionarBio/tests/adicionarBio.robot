*** Settings ***
Library    SeleniumLibrary
Resource    ../resources/keywords.robot
Resource    ../../publicarEvento/resources/keywords.robot

*** Test Cases ***
Adicionar Biografia
    Abrir Site na Página Principal
    Fazer Login
    Acessar Página de Perfil
    Adicionar Biografia
    Verificar Biografia
    Fechar Browser
