
<?php
use PHPUnit\Framework\TestCase;
use SCRIPTS\PHP\Cypher\EncodeDecode;

final class CriarSenhaIncriptadaTest extends TestCase {
    public function testCriarSenhaIncriptadaValida(): void {
        $senhaTest = "123456789";
        $_ENCODE = new EncodeDecode();
        $senhaTestIncriptada = $_ENCODE->encrypt($senhaTest);
        $this->assertFileNotEquals($senhaTest, $senhaTestIncriptada);
    }
    public function testCriarSenhaIncriptadaInvalida(): void {
        $this->expectException(TypeError::class);
        $_ENCODE = new EncodeDecode();
        $_ENCODE->encrypt(null);
    }
}
