<?php
include_once 'arrayJSON.php'; // Se você precisa usar funções daí

$filename = "/xampp/htdocs/DailyGreen-Project/JSON/postagem.json";

// Verifica se veio algo no POST
if (isset($_POST["postagem"])) {
    $novaPostagem = [
        "texto" => $_POST["postagem"],
        "data" => date("Y-m-d H:i:s")
    ];

    // Lê conteúdo atual do JSON (se existir)
    if (file_exists($filename)) {
        $conteudoAtual = file_get_contents($filename);
        $dados = json_decode($conteudoAtual, true);

        // Se JSON estiver corrompido, começa vazio
        if (!is_array($dados)) {
            $dados = [];
        }
    } else {
        $dados = [];
    }

    // Adiciona a nova postagem
    $dados[] = $novaPostagem;

    // Salva no arquivo com indentação
    $jsonFinal = json_encode($dados, JSON_PRETTY_PRINT);
    file_put_contents($filename, $jsonFinal);

    // Redireciona para a página de postagens
    header("Location: /DailyGreen-Project/SCRIPTS/HTML/pagina_postagens.html");
    exit();
} else {
    echo "Erro: Nenhuma postagem recebida.";
}
?>