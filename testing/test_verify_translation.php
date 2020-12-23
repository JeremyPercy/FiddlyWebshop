<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door: Martijn Dijkgraaf
 * In opdracht van: Fiddly
 *
 */

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../app/bootstrap.php';

	class VerifyTranslation extends TestCase
{
    public function testTranslation()
    {
    	$oTranslate = new Translate();
        $this->assertEquals('Deze vertaling klopt',$oTranslate->translate('test-key'), 'Deze vertaling klopt niet');
    }
}