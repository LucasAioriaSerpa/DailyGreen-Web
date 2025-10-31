
<?php
include_once('Cypher.php');
$encodeDecode = new EncodeDecode();
session_start();
$session_array = [];
$session_array['user'] = [
    'type' => null,
    'loged' => false,
    'find' => null,
    'account' => null,
    'org' => null
];
$session_array['mySql'] = [
    'servername' => 'localhost',
    'username' => 'root',
    'password' => $encodeDecode->encrypt('root#root031023'),
    'database' => 'db_dailygreen',
    'port' => 3306,
    'flag-connection' => true
];
$session_array['inputs'] = [
    'login' => [
        'email' => null,
        'password' => null
    ],
    'cadastro' => [
        'cad-part' => '0',
        'part-1' => [
            'nome' => null,
            'biografia' => null,
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
$session_array['initialized'] = true;
if (!isset($_SESSION['initialized']) || !$_SESSION['initialized']) {$_SESSION = $session_array;
} elseif ($_SESSION['mySql']['password'] === '' && $_SESSION['mySql']['flag-connection'] === false) {
    $_SESSION['mySql']['flag-connection'] = true;
    header("Location: /DailyGreen-Project/SCRIPTS/PHP/SQL_connection_error.php");
    exit;
}
