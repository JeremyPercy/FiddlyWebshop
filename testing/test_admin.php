<?php
/**
 * Copyright in opdracht van Fiddly
 */

/**
 * Created by PhpStorm.
 * User: yweij
 * Date: 17-6-2018
 * Time: 13:56
 */

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../app/bootstrap.php';


class TestAdmin extends TestCase
{
    public function testAddProduct()
    {
        $oProductModel = new Product();

        $data = [
            'productName' => "testName",
            'description' => "testDescription",
            'description_en' => "testDescriptionEn",
            'image_link' => "test.png"
    ];

	    $oProductModel->addProduct($data);

        $this->assertTrue( $oProductModel->addProduct($data), 'product toevoegen mislukt');
    }
}
