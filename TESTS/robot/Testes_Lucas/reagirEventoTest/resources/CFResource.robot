
*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${BROWSER}    chrome
${URL}    http://localhost/DailyGreen-Project/SCRIPTS/PHP/MAIN-PAGE.php
${BTN_CADASTRO}    name=btn-cadastro

*** Keywords ***

Abrir o navegador
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window



Fechar o navegador
    Run Keyword If    '${TEST STATUS}' == 'FAIL'    Capture Page Screenshot
    Close Browser
