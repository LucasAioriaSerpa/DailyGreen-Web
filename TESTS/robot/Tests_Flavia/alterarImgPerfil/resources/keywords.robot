*** Settings ***
Library    SeleniumLibrary
Resource    variables.robot
Resource    ../../adicionarBio/resources/keywords.robot

*** Keywords ***
Subir Imagem de Perfil
    [Documentation]    Clica no botão de alterar imagem de perfil, seleciona uma imagem e clica no botão de salvar
    Wait Until Element Is Visible    ${BOTAO_EDITAR_PERFIL}    timeout=5s
    Click Button    ${BOTAO_EDITAR_PERFIL}
    Wait Until Element Is Visible    ${BOTAO_SELECIONAR_IMAGEM}    timeout=5s
    Choose File    ${BOTAO_SELECIONAR_IMAGEM}    ${CAMINHO_IMAGEM}
    Sleep    1s
    Click Element    ${BOTAO_SALVAR_FOTO_PERFIL}

Verificar Imagem de Perfil Foi Alterada
    [Documentation]    Verifica se a imagem de perfil foi alterada com sucesso capturando o src antes e depois
    [Arguments]    ${src_original}
    Wait Until Element Is Visible    ${IMG_PERFIL}    timeout=10s
    Sleep    2s
    ${src_novo}=    Get Element Attribute    ${IMG_PERFIL}    src
    Should Not Be Equal    ${src_original}    ${src_novo}    msg=A imagem de perfil não foi alterada!
    Log    Imagem alterada com sucesso! SRC antigo: ${src_original}, SRC novo: ${src_novo}

Capturar SRC da Imagem de Perfil
    [Documentation]    Captura o atributo src atual da imagem de perfil
    Wait Until Element Is Visible    ${IMG_PERFIL}    timeout=5s
    ${src}=    Get Element Attribute    ${IMG_PERFIL}    src
    RETURN    ${src}