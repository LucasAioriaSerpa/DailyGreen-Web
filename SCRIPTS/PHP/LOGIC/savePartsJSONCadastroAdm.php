<?php
    include 'arrayJSON.php';

    $cadastroAdm = updateCadastroSaveAdm();
    $JSON_String = json_encode($cadastroAdm,JSON_PRETTY_PRINT);

    file_put_contents('/xampp/htdocs/DailyGreen-Project/JSON/cad_log_adm.json', $JSON_String);

    header("Location: /DailyGreen-Project/SCRIPTS/PHP/LOGIC/AdmSendCadastro.php");
