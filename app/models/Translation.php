<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door:Martijn Dijkgraaf
 *
 */

/**
 * Created by PhpStorm.
 * User: martijndijkgraaf
 * Date: 22/05/2018
 * Time: 18:55
 */

class Translation {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	/**
	 * @param null $sKey
	 * @param string $sLanguage
	 *
	 * @return string
	 */
	public function getTranslation($sKey = null, $sLanguage = 'nl'){
		if(!$sKey){
			return 'Vul een key in';
		}

		$this->db->query('SELECT value_'.$sLanguage.' as value FROM `translation` WHERE `key` = :key');
		$this->db->bind(':key', $sKey);

		if($sResult = $this->db->single()){
			return $sResult->value;
		} else {
			return null;
		}
	}

	public function setTranslationKey($sKey = null){
		//controleren of hij echt nog niet bestaat
		$this->db->query('SELECT `key` FROM `translation` WHERE `key` = :key');
		$this->db->bind(':key', $sKey);
		$sResult =	$this->db->single();

		if($sResult){
			return true;
		}

		$this->db->query('INSERT into `translation`(`key`) VALUES (:key)');
		$this->db->bind(':key', $sKey);

		$this->db->execute();
	}


}