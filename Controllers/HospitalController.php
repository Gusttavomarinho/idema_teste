<?php
namespace Controllers;

use \Core\Controller;
use \Models\Hospital;

class HospitalController extends Controller {

	public function index() {
		$array = array();

		$hospital = new Hospital();
		$dados['hospitais'] = $hospital->getAll();

		$this->loadTemplate('hospital', $dados);
	}

}