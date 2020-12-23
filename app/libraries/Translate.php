<?php

/**
 * Created by PhpStorm.
 * User: martijndijkgraaf
 * Date: 22/05/2018
 * Time: 18:54
 */
class Translate extends Controller {

	private $translationModel;
	private $sDefaultLanguage = 'nl';
	private $sLanguage;
	private $aLanguages = Array('nl', 'en');

	/**
	 * translate_helper constructor.
	 */
	public function __construct() {
		$this->translationModel = $this->model('Translation');
		$this->setLanguage();
	}

	/**
	 *
	 */
	public function setLanguage(){
		if (!$this->sLanguage && isset($_GET) && !isset($_GET['language']) && !isset($_SESSION['language'])){
			$_SESSION['language'] = $this->sLanguage = $this->sDefaultLanguage;
		} else if((isset($_GET) && !empty($_GET['language']) && in_array($_GET['language'], $this->aLanguages))){
			$_SESSION['language'] = $this->sLanguage = $_GET['language'];
		} else if (isset($_SESSION['language'])){
			$this->sLanguage = $_SESSION['language'];
		} else {
			$this->sLanguage = $this->sDefaultLanguage;
		}
	}

	/**
	 * @param null $sKey
	 *
	 * @return string
	 */
	public function translate($sKey = null){
		if (!$sKey){
			return 'vul een key in';
		}
		$sTranslation = $this->translationModel->getTranslation($sKey, $this->sLanguage);

		// Is the translation not yet in the database ?
		if (empty($sTranslation)) {
			$this->translationModel->setTranslationKey($sKey);
			return 'KEY:<b><i> '.$sKey.'</i></b> NIET GEVULD';
		} else {
			return $sTranslation;
		}
	}

	public function getLanguage(){
		return $this->sLanguage;
	}

	public function isEnglish(){
		return ($this->getLanguage() == 'en');
	}
}