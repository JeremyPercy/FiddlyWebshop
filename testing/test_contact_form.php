<?php
/**
 * Created by PhpStorm.
 * User: Maarten
 * Date: 10/06/2018
 * Time: 20:39
 */


use PHPUnit\Framework\TestCase;

require __DIR__ . '/../app/bootstrap.php';

class ControlFormTest extends TestCase {
    public function testGetAllContactForms() {

        $oContactModel = new ContactModel();

        $data = [
            'contact_id' => "3",
            'email' => "m@m.mc",
            'name' => "Maarten",
            'subject' => "Test",
            'message' => "testing testen"
        ];

        $bResult = $oContactModel->storeContactForm($data);
        $this->assertTrue( $bResult, 'test mislukt');
    }
}

?>