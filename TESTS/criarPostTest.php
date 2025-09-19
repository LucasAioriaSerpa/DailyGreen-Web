
<?php
use PHPUnit\Framework\TestCase;
include_once "SCRIPTS/PHP/LOGIC/SQL_connection.php";

final class CriarPostTest extends TestCase {
    private SQLconnection $db;
    protected function setUp(): void { $this->db = new SQLconnection(); }
    public function testEnvioPostagemValida(): void {
        $sqlQuery = "INSERT INTO post(
            id_autor,
            titulo,
            descricao
        ) VALUES (
            '0',
            'titulo',
            'descricao'
        )";
        $initialPostCounter = count($this->db->callTableBD("post"));
        $last_id = $this->db->insertQueryBD($sqlQuery);
        $finalPostCounter = count($this->db->callTableBD("post"));
        $this->assertIsNumeric($last_id);
        $this->assertEquals($initialPostCounter + 1, $finalPostCounter);
    }
    public function testEnvioPostagemInvalida(): void{
        $this->expectException(TypeError::class);
        $this->db->insertQueryBD(null);
    }
}
