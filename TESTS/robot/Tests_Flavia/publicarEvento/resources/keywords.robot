*** Settings ***
Library    SeleniumLibrary
Resource    variables.robot

*** Keywords ***
Abrir Site na Página Principal
    [Documentation]    Abre o site DailyGreen na página principal
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

Fazer Login como Participante
    [Documentation]    Faz o login como participante já cadastrado
    Click Link    ${BOTÃO_LOGIN}
    Input Text    ${CAMPO_EMAIL}    flaviafagundes@gmail.com
    Input Password    ${CAMPO_SENHA}    123456789
    Click Button    ${BOTAO_ENTRAR}

Publicar Postagem
    [Documentation]    Publica uma nova postagem na plataforma
    Input Text    ${CAMPO_TITULO}    Publicação de Teste
    Input Text    ${CAMPO_DESCRICAO}    ${DESCRIÇAO}
    Click Button    ${BOTAO_POSTAR}

Verificar Postagem
    [Documentation]    Verifica se a postagem foi publicada com sucesso[Arguments]    ${texto_esperado}    ${seletor_elemento}
    ${classe_content}=    Get Text    class=post-content
    Should Contain    ${classe_content}    ${DESCRIÇAO}

Fechar Browser
    [Documentation]    Fecha o navegador
    Close Browser
