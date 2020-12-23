<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door: Martijn Dijkgraaf
 * In opdracht van: Fiddly
 *
 */

class SearchWords {
  private $db;

	/**
	 * Product constructor.
	 */
	public function __construct() {
    $this->db = new Database;
  }


  //serach the keyword in the description, link and the words.
    public function search($searchWord){
	    $this->db->query("SELECT * FROM `search_word` WHERE `description` LIKE :searchWord OR `description_en` LIKE :searchWord OR  `word` LIKE :searchWord
		AND ((`description` IS NOT NULL OR `description_en` IS NOT NULL) OR `link` IS NOT NULL AND `link` != '')");
	    $searchWord = strtolower($searchWord);
	    $this->db->bind(':searchWord', '%'.$searchWord.'%');

		return $this->db->resultSet();

    }

    //if the keyword doesnt exist, add to database
	public function setSearchWord($sKey = null){
		$this->db->query('SELECT `word`, `count` FROM `search_word` WHERE `word` = :key');
		$this->db->bind(':key', $sKey);
		$sResult =	$this->db->single();

		if($sResult){
			$nTotal = ($sResult->count + 1);
			$this->db->query('UPDATE `search_word` SET `count` = :total WHERE `word` = :key');
			$this->db->bind(':total', $nTotal);
			$this->db->bind(':key', $sKey);
			$this->db->execute();

			return true;
		}

		$this->db->query('INSERT into `search_word`(`word`) VALUES (:key)');
		$this->db->bind(':key', $sKey);

		$this->db->execute();
	}

	public function getAllSearchWords() {
		$this->db->query('SELECT * FROM `search_word`');
		$results = $this->db->resultSet();
		return $results;

	}

	public function getSearchWord($id) {
		$this->db->query('SELECT * FROM `search_word` WHERE `search_word_id` = :id');
		$this->db->bind(':id', $id);

		$result = $this->db->single();

		return $result;
	}

	public function deleteSearchword($id) {
		$this->db->query('DELETE FROM `search_word` WHERE `search_word_id` = :id');
		$this->db->bind('id', $id);
		$this->db->execute();
	}

	public function editSearchWord($data) {
		$this->db->query('UPDATE `search_word` SET `word` = :word, `description` = :description,  `description_en` = :description_en, `link` = :link WHERE search_word_id = :id');
		$this->db->bind('word',$data['word']);
		$this->db->bind('description',$data['description']);
		$this->db->bind('description_en',$data['description_en']);
		$this->db->bind('link',$data['link']);
		$this->db->bind('id',$data['id']);

		// Execute
		if ($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}

}