*** Settings ***
Library    SeleniumLibrary
Resource    variables.robot
Resource    ../../publicarEvento/resources/variables.robot

*** Keywords ***
Fazer Login Participante
    [Documentation]    Faz o login como participante já cadastrado
    Click Link    ${BOTÃO_LOGIN}
    Input Text    ${CAMPO_EMAIL}    fernandatorres@gmail.com
    Input Password    ${CAMPO_SENHA}    jfhjdfsjkadnfujiwbeinfjsb
    Click Button    ${BOTAO_ENTRAR}

Denunciar Usuário
    [Documentation]    Clica na foto de perfil do usuário, clica no botão de denunciar e preenche o formulário de denuncia
    Click Element    ${USER_IMG}
    Wait Until Element Is Visible    ${BOTAO_DENUNCIA}    timeout=5s
    Click Element    ${BOTAO_DENUNCIA}
    Sleep    0.5s
    Select From List By Value    ${TITULO_DENUNCIA}    Conteudo_fora_do_tema
    Click Element    ${MOTIVO_DENUNCIA}
    Sleep    0.5s
    Select From List By Value    ${MOTIVO_DENUNCIA}    Postagens que não se relacionam com os tópicos do fórum.
    Click Button    ${BOTAO_ENVIAR_DENUNCIA}
    Sleep    1s
    Click Button    Confirmar
    Sleep    1s
    Click Button    OK

Verificar Denuncia
    [Documentation]    Verifica se a denuncia foi enviada com sucesso
    Page Should Contain    Para você
