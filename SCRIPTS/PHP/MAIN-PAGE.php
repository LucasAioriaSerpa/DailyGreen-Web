
<?php
session_start();
if (!isset($_SESSION['initialized']) || !$_SESSION['initialized']) {
    $_SESSION['user'] = [
        'type' => 'USER',
        'loged' => false,
        'account' => null
    ];
    $_SESSION['mySql'] = [
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'db_dailygreen',
        'port' => 3306
    ];
    $_SESSION['inputs'] = [
        'login' => [
            'email' => null,
            'password' => null
        ],
        'cadastro' => [
            'cad-part' => '0',
            'part-1' => [
                'nome' => null,
                'email' => null,
                'org' => null
            ],
            'part-1-org' => [
                'org-nome' => null,
                'CNPJ' => null
            ],
            'part-2' => [
                'file' => null,
                'genero' => null
            ],
            'part-3' => [
                'senha' => null
            ]
        ]
    ];
    $_SESSION['initialized'] = true;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyGreen - HOME</title>
</head>
<body>
    
</body>
</html>
