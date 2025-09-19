
<?php
use PHPUnit\Framework\TestCase;
include_once "SCRIPTS/PHP/LOGIC/Cypher.php";

final class CriarSenhaIncriptadaTest extends TestCase {
    public function testCriarSenhaIncriptadaValida(): void {
        $senhaTest = "123456789";
        $_ENCODE = new EncodeDecode();
        $senhaTestIncriptada = $_ENCODE->encrypt($senhaTest);
        $this->assertNotEquals($senhaTest, $senhaTestIncriptada);
    }
    public function testCriarSenhaIncriptadaInvalida(): void {
        $this->expectException(TypeError::class);
        $_ENCODE = new EncodeDecode();
        $_ENCODE->encrypt(null);
    }
}
