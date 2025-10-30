*** Settings ***
Library    SeleniumLibrary
Resource    ../resources/variables.robot

*** Keywords ***
Acessar Página de Perfil
    [Documentation]    Acessa a página de perfil
    Click Element    ${BOTAO_PERFIL}

Adicionar Biografia
    [Documentation]    Adiciona uma biografia ao perfil do usuário
    Wait Until Element Is Visible    ${BOTAO_EDITAR_PERFIL}    timeout=5s
    Click Button    ${BOTAO_EDITAR_PERFIL}
    Click Element    ${CAMPO_BIOGRAFIA}
    Input Text    ${CAMPO_BIOGRAFIA}    ${TEXTO_BIOGRAFIA}
    Sleep    1s
    Click Button    ${BOTAO_SALVAR_BIOGRAFIA}

Verificar Biografia
    [Documentation]    Verifica se a biografia foi adicionada com sucesso
    Page Should Contain    ${TEXTO_BIOGRAFIA}