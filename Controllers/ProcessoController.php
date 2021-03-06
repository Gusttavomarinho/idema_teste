<?php

namespace Controllers;

use \Core\Controller;
use \Models\Processo;
use \Models\Users;

class ProcessoController extends Controller
{
	private $processo;
	private $user;

	public function __construct()
	{
		$this->processo = new Processo();
		$this->user = new Users();

		//verificar se esta logado
		if (!$this->user->verifyLogin()) {
			header("Location:" . BASE_URL . "login");
			exit;
		}
	}

	public function index()
	{
		$id_user = $this->user->infoUser()['id'];
		$dados['processos'] = $this->processo->getAllbyuser($id_user);

		$this->loadTemplate('processo/processo', $dados);
	}
}
