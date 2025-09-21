
<?php
use PHPUnit\Framework\TestCase;
include_once "SCRIPTS/PHP/LOGIC/SQL_connection.php";

CLASS BiografiaService {
    private SQLconnection $db;
    public function __construct(SQLconnection $db) { $this->db = $db; }
    public function adicionarBiografia(string $biografia, int $idParticipante): bool {
        $SQLquery = "UPDATE participante SET biografia = '{$biografia}' WHERE id_participante = '{$idParticipante}'";
        return $this->db->insertQueryBD($SQLquery);
    }
}

final class adicionarBiografiaTest extends TestCase {
    public function testAdicionarBiografiaComSucesso(): void {
        $sqlConnectionMock = $this->createMock(SQLconnection::class);
        $sqlConnectionMock  ->method('insertQueryBD')
                            ->willReturn(true);
        $biografiaService = new BiografiaService($sqlConnectionMock);
        $result = $biografiaService->adicionarBiografia('Nova Biografia', 0);
        $this->assertTrue($result);
    }
    public function testAdicionarBiografiaComFalhaNaConexao(): void {
        $sqlConnectionMock = $this->createMock(SQLconnection::class);
        $sqlConnectionMock  ->method('insertQueryBD')
                            ->willReturn(false);
        $biografiaService = new BiografiaService($sqlConnectionMock);
        $result = $biografiaService->adicionarBiografia('Nova biografia', 0);
        $this->assertFalse($result);
    }
}
