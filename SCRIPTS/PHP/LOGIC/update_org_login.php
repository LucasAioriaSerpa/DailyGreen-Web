
<?php
session_start(); // Inicia a sessão

// Obtém os dados enviados via POST
$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['org'])) {
    // Atualiza o valor de 'org' na sessão
    $_SESSION['user']['org'] = $data['org'];

    // Retorna uma resposta de sucesso
    echo json_encode(['status' => 'success', 'message' => 'Session updated successfully']);
} else {
    // Retorna uma resposta de erro
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
