*** Settings ***
Library    SeleniumLibrary
Resource    ../resources/keywords.robot
Resource    ../../denunciarUser/resources/keywords.robot
Resource    ../../publicarEvento/resources/keywords.robot

*** Test Cases ***
Alterar Imagem de Perfil
    Abrir Site na Página Principal
    Fazer Login Participante
    Acessar Página de Perfil
    ${src_original}=    Capturar SRC da Imagem de Perfil
    Subir Imagem de Perfil
    Verificar Imagem de Perfil Foi Alterada    ${src_original}
    Close Browser