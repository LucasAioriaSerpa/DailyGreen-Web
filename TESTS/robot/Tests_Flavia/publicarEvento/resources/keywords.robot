*** Settings ***
Library    SeleniumLibrary
Library    String
Resource    variables.robot

*** Keywords ***
Abrir Site na Página Principal
    [Documentation]    Abre o site DailyGreen na página principal
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

Fazer Login como Organizacao
    [Documentation]    Faz o login como organização já cadastrada
    Click Link    ${BOTÃO_LOGIN}
    Input Text    ${CAMPO_EMAIL}    posigraf@outlook.com
    Input Password    ${CAMPO_SENHA}    iwusmsfbskhfowiuwnkjsfsihoiweh
    Click Button    ${BOTAO_ENTRAR}

Publicar Evento
    [Documentation]    Publica um novo evento na plataforma
    # Aguarda os campos estarem visíveis e prontos
    Wait Until Element Is Visible    ${CAMPO_TITULO}    timeout=10s
    Wait Until Element Is Visible    ${CAMPO_DESCRICAO}    timeout=10s
    
    # Preenche o título
    Sleep    0.10s
    Click Element    ${CAMPO_TITULO}
    Input Text    ${CAMPO_TITULO}    Evento de Teste
    
    # Preenche a descrição (com espera adicional)
    Sleep    0.5s
    Click Element    ${CAMPO_DESCRICAO}
    Input Text    ${CAMPO_DESCRICAO}    ${DESCRIÇAO}
    
    Wait Until Element Is Visible    ${CAMPO_DATA_INICIO}
    Sleep    0.5s
    Input Text    ${CAMPO_DATA_INICIO}    ${DATA_INICIO}
    Press Keys    ${CAMPO_DATA_INICIO}    ${HORA_INICIO}
    
    Wait Until Element Is Visible    ${CAMPO_DATA_FIM}
    Sleep    0.5s
    Input Text    ${CAMPO_DATA_FIM}    ${DATA_FIM}
    Press Keys    ${CAMPO_DATA_FIM}    ${HORA_FIM}
    
    Wait Until Element Is Visible    ${CAMPO_LOCAL}    timeout=5s
    Click Element    ${CAMPO_LOCAL}
    Input Text    ${CAMPO_LOCAL}    Rua dos Bobos, 0
    
    Wait Until Element Is Visible    ${CAMPO_LINK}    timeout=5s
    Click Element    ${CAMPO_LINK}
    Input Text    ${CAMPO_LINK}    https://www.bobos.com
    
    # Aguarda antes de clicar em postar
    Sleep    1s
    Click Button    ${BOTAO_POSTAR}

Verificar Evento
    [Documentation]    Verifica se o evento foi publicado com sucesso
    ${classe_content}=    Get Text    class=post-content
    Should Contain    ${classe_content}    ${DESCRIÇAO}

Fechar Browser
    [Documentation]    Fecha o navegador
    Close Browser
