<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../app/bootstrap.php';

class VerifyLogin extends TestCase {

  public function testLoginUser() {
    $user = new User;
    $email = 'user@fiddly.nl';
    $password = '123456';

    $user = $user->login($email, $password);

    $this->assertInternalType('object', $user);
    $this->assertEquals('2', $user->role_id_FK);
  }

  public function testLoginAdmin() {
    $user = new User;
    $email = 'admin@fiddly.nl';
    $password = '123456';

    $user = $user->login($email, $password);

    $this->assertInternalType('object', $user);
    $this->assertEquals('1', $user->role_id_FK);
  }
}
