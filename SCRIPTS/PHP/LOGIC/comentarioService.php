<?php
class ComentarioService {
    private SQLconnection $db;
    public function __construct(SQLconnection $db) {
        $this->db = $db;
    }
    public function inserirComentario(
        string $idPost,
        string $idAutorComentario,
        string $titulo,
        string $descricao
    ): bool|int {
        $queryBD = "INSERT INTO comentario(
            id_post,
            id_autor_comentario,
            titulo_comentario,
            descricao_comentario
        ) VALUES (
            '{$idPost}',
            '{$idAutorComentario}',
            '{$titulo}',
            '{$descricao}'
        )";
        return $this->db->insertQueryBD($queryBD);
    }
}