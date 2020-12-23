<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door: Martijn Dijkgraaf
 * In opdracht van: Fiddly
 *
 */

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../app/bootstrap.php';

	class VerifyRandomLocation extends TestCase
{
    public function testRandomLongAndLat()
    {
    	$oTrackers = new Trackers();
        $this->assertArrayHasKey('lattitude',$oTrackers->getRandomLongitudeLattitude(), 'Lattitude ontbreekt');
        $this->assertArrayHasKey('longitude',$oTrackers->getRandomLongitudeLattitude(), 'Longitude ontbreekt');
    }
}