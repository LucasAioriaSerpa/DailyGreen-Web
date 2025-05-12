
<?php
session_start();
$sqlData = $_SESSION['mySql'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DailyGreen-Project/SCRIPTS/CSS/style_connection_error.css">
    <title>SQL CONNECTION ERROR</title>
</head>

<body>
    <section class="error-connection">
        <h1>✖ Falha na conexão! ✖</h1>
        <div class="forms">
            <form id="formBD" name="formBD" action="LOGIC/update_SQLbd_info" method="post">
                <div class="forms-inputs">
                    <div class="data-input">
                        <label for="servername">Server name:</label>
                        <input type="text" id="servername" name="servername" value="localhost" value="<?php $sqlData['servername'] ?>" required>
                    </div>
                    <div class="data-input">
                        <label for="username">User name:</label>
                        <input type="text" id="username" name="username" value="root" value="<?php $sqlData['username'] ?>" required>
                    </div>
                    <div class="data-input">
                        <label for="password">Password:</label>
                        <div class="password-input">
                            <input type="password" id="password" name="password" value="<?php $sqlData['password'] ?>" required>
                            <input type="checkbox" onclick="togglePasswordInput()" onkeypress="togglePasswordInput()">
                        </div>
                    </div>
                    <div class="data-input">
                        <label for="database">Database:</label>
                        <input type="text" id="database" name="database" value="<?php $sqlData['database'] ?>" required>
                    </div>
                    <div class="data-input">
                        <label for="port">Port:</label>
                        <input type="text" id="port" name="port" value="<?php $sqlData['port'] ?>" required>
                    </div>
                </div>
                <div class="btn-connect"><input type="submit" value="Conectar"></div>
            </form>
        </div>
    </section>
</body>

<script src="/DailyGreen-Project/SCRIPTS/JS/connection_error.js"></script>

</html>
