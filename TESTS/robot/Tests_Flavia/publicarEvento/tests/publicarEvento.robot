*** Settings ***
Library    SeleniumLibrary
Resource    ../resources/keywords.robot

*** Test Cases ***
Publicar Uma Postagem
    Abrir Site na Página Principal
    Fazer Login como Participante
    Publicar Postagem
    Verificar Postagem
    Fechar Browser
