*** Settings ***
Library    SeleniumLibrary
Resource    ../resources/keywords.robot

*** Test Cases ***
Publicar Um Evento
    Abrir Site na Página Principal
    Fazer Login
    Publicar Evento
    Verificar Evento
    Fechar Browser
