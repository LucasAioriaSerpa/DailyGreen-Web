<?php
$postagem = $_POST['postagem'] ?? '';
$arquivo = '/xampp/htdocs/DailyGreen-Project/JSON/postagem.json'; 

$dados = [];


if (file_exists($arquivo)) {
    $conteudo = file_get_contents($arquivo);
    $dados = json_decode($conteudo, true);


    if (json_last_error() !== JSON_ERROR_NONE) {

        error_log("Erro ao decodificar JSON: " . json_last_error_msg());

        $dados = [];
    }
}

$dados[] = [
    'texto' => $postagem,
    'data' => date('Y-m-d H:i:s')
];

file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT));

echo "Postagem salva com sucesso!";
?>