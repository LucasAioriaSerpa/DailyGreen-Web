
<?php
include_once 'SQL_connection.php';
include_once 'functions.php';
//* array - table
$sqlConnection = new SQLconnection();
$loginTable = $sqlConnection->callTableBD("participante");
debug_var($loginTable[0]); // TODO: TRY TO FIND THE EMAIL & PASSWORD VALUES IN THE ARRAY

//* verify if the login exists


//* verify if the password is correct

