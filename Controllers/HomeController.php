<?php

namespace Controllers;

use \Core\Controller;
use \Models\Users;

class HomeController extends Controller
{
	private $user;

	public function __construct()
	{
		$this->user = new Users();
		if (!$this->user->verifyLogin()) {
			header("Location:" . BASE_URL . "login");
			exit;
		}
	}

	public function index()
	{
		$dados = [
			'error' => '', 'user_info' => $this->user->infoUser()
		];
		if (!isset($_SESSION['global_user_info'])) {
			$_SESSION['global_user_info'] = $this->user->infoUser();
		}


		$this->loadTemplate('home', $dados);
	}

	public function sair()
	{
		unset($_SESSION["hashlogin"]);
		unset($_SESSION['global_user_info']);
		$_SESSION = [];
		$_SESSION['msg'] = 'usuario-deslogado';
		header("Location:" . BASE_URL . "login");
		session_destroy();
		exit;
	}

	public function sempermissao()
	{
		echo 'Sem Permissao!';
		exit;
	}
}
