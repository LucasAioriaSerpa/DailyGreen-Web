
<?php
use PHPUnit\Framework\TestCase;
include_once "SCRIPTS/PHP/LOGIC/SQL_connection.php";

final class CriarPostTest extends TestCase {
    private SQLconnection $db;
    protected function setUp(): void { $this->db = new SQLconnection(); }
    public function testEnvioPostagemValida(): void {
        $cypherMock = $this->createMock(EncodeDecode::class);
        $cypherMock ->method('decrypt')
                    ->willReturn('mock_password');
        $sqlConnectionMock = $this  ->getMockBuilder(SQLconnection::class)
                                    ->setConstructorArgs([$cypherMock])
                                    ->onlyMethods(['callTableBD', 'insertQueryBD'])
                                    ->getMock();
        $sqlConnectionMock  ->method('callTableBD')
                            ->willReturnOnConsecutiveCalls([], ['post1']);
        $sqlConnectionMock  ->method('insertQueryBD')
                            ->willReturn(1);
        $sqlQuery = "INSERT INTO post(
            id_autor,
            titulo,
            descricao
        ) VALUES (
            '0',
            'titulo',
            'descricao'
        )";
        $initialPostCounter = count($sqlConnectionMock->callTableBD("post"));
        $last_id = $sqlConnectionMock->insertQueryBD($sqlQuery);
        $finalPostCounter = count($sqlConnectionMock->callTableBD("post"));
        $this->assertIsNumeric($last_id);
        $this->assertEquals($initialPostCounter + 1, $finalPostCounter);
    }
    public function testEnvioPostagemInvalida(): void{
        $this->expectException(TypeError::class);
        $this->db->insertQueryBD(null);
    }
}
