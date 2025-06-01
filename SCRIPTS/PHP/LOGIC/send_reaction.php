
<?php
/* //? Tipos de reacao :]
* gostei
* parabens
* apoio
* amei
* genial
* divertido
*/
include_once 'session.php';
include_once 'SQL_connection.php';
include_once 'functions.php';
$__SQLconnection = new SQLconnection();
$_reactionsArrayPost = $__SQLconnection->callTableBD('reacaopost');
$_reactionsArrayComment = $__SQLconnection->callTableBD('reacaocomentario');
$_reactionsType = [
    'reaction-gostei'   => 'Gostei found!',
    'reaction-parabens' => 'Parabéns found!',
    'reaction-apoio'    => 'Apoio found!',
    'reaction-amei'     => 'Amei found!',
    'reaction-genial'   => 'Genial found!',
];
echo "$._POST : "; debug_var($_POST);
echo "$._reactionsArrayPost : "; debug_var($_reactionsArrayPost);
echo "$._reactionsArrayComment : "; debug_var($_reactionsArrayComment);
function handleReaction($type, $arrayReactions, $tableName, $idField, $redirectUrl, $reactionsType) {
    $idKey = $type === 'post' ? 'id_post' : 'id_comentario';
    if (!isset($_POST[$idKey])) return false;
    $idValue = $_POST[$idKey];
    // ? verifica se ja possui reação
    foreach ($arrayReactions as $reaction) {
        foreach ($reactionsType as $key => $message) {
            if (isset($_POST[$key])) {
                $autorId = $_POST[$key][0];
                if (
                    $reaction[$idField] == $idValue &&
                    $reaction['id_autor_reacao'] == $autorId &&
                    $reaction['reaction'] == str_replace("{$autorId}-", "", $_POST[$key])
                ) {
                    // ? remove a reação
                    $__IdReacao = $reaction['id_reacao'];
                    $_Query = "DELETE FROM $tableName WHERE (id_reacao = '{$__IdReacao}');";
                    global $__SQLconnection;
                    $__SQLconnection->insertQueryBD($_Query);
                    header("Location: $redirectUrl");
                    exit;
                }
            }
        }
    }
    // ? adiciona a reação
    foreach ($reactionsType as $key => $message) {
        if (isset($_POST[$key])) {
            echo 'reaction type found!';
            $autorId = $_POST[$key][0];
            $typeReaction = str_replace("{$autorId}-", "", $_POST[$key]);
            $_Query = "INSERT INTO $tableName (
                $idField,
                id_autor_reacao,
                reaction
            ) VALUES (
                '{$idValue}',
                '{$autorId}',
                '{$typeReaction}'
            )";
            global $__SQLconnection;
            $__SQLconnection->insertQueryBD($_Query);
            header("Location: $redirectUrl");
            exit;
        }
    }
    echo "reaction type not found!";
    exit;
}

// Handle post reactions
handleReaction(
    'post',
    $_reactionsArrayPost,
    'reacaopost',
    'id_reacaoPost',
    '/DailyGreen-Project/SCRIPTS/PHP/postagens.php',
    $_reactionsType
);

// Handle comment reactions
handleReaction(
    'comment',
    $_reactionsArrayComment,
    'reacaocomentario',
    'id_reacaoComentario',
    '/DailyGreen-Project/SCRIPTS/PHP/postagens.php',
    $_reactionsType
);
