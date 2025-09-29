<?php
use PHPUnit\Framework\TestCase;
include_once "SCRIPTS/PHP/LOGIC/SQL_connection.php";
include_once "SCRIPTS/PHP/LOGIC/comentarioService.php";

final class InsercaoDeComentarioComSucessoTest extends TestCase {
    public function testInsercaoDeComentarioComSucesso(): void {
        $sqlConnectionMock = $this->createMock(SQLconnection::class);
        $sqlConnectionMock  ->method('insertQueryBD')
                            ->willReturn(42);
        $service = new ComentarioService($sqlConnectionMock);
        $lastId = $service->inserirComentario(
            '10',
            '5',
            'Teste',
            'Descrição.'
        );
        $this->assertEquals(42, $lastId);
        $sqlConnectionMock  ->expects($this->once())
                            ->method('insertQueryBD')
                            ->with($this->stringContains("INSERT INTO comentario(id_post,"));
    }
}