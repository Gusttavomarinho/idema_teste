<?php

namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Hospital;

class UserController extends Controller
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
		$dados['usuarios'] = $this->user->getAll();
		$this->loadTemplate('usuarios/usuarios', $dados);
	}

	public function editar($id)
	{
		$dados = [
			'error' => '', 'user_info' => $this->user->infoUser()
		];
		$id = intval(filter_input(INPUT_GET, 'id'));
		$dados['usuario'] = $this->user->getById($id);
		$this->loadTemplate('usuarios/editar', $dados);
	}

	public function log_editar($post)
	{
		//registrando o log
		$usuario_logado = $this->user->infoUser();
		$dados_log = json_encode($post);
	}

	public function editar_action()
	{
		$id = intval(filter_input(INPUT_POST, 'id'));
		$username = \strtolower(filter_input(INPUT_POST, 'username'));
		$id_hospital = intval(filter_input(INPUT_POST, 'id_hospital'));
		$perfil = filter_input(INPUT_POST, 'perfil');
		$ativo = filter_input(INPUT_POST, 'ativo');
		$nova_senha = filter_input(INPUT_POST, 'nova_senha');
		$confirmar_nova_senha = filter_input(INPUT_POST, 'confirmar_nova_senha');

		$usuario = $this->user->getById($id);

		if ($nova_senha !== $confirmar_nova_senha) {
			$_SESSION['msg'] = 'senhas-diferentes';
			\header("Location:" . BASE_URL . "user/editar/?id=" . $id);
			exit;
		} else {
			if ($this->user->validateUsername($username)) {
				if ($usuario['username'] !== $username) {
					if (!$this->user->userExists($username)) {
						if ($nova_senha) {
							$passHash = \password_hash($nova_senha, PASSWORD_DEFAULT);
							$this->log_editar($_POST);
							$this->user->updateUserWithPass($username, $id_hospital, $perfil, $ativo, $passHash, $id);
						} else {
							$this->log_editar($_POST);
							$this->user->updateUser($username, $id_hospital, $perfil, $ativo, $id);
						}
						$_SESSION['msg'] = 'registro-alterado';
						\header("Location:" . BASE_URL . "user");
						exit;
					} else {
						$_SESSION['msg'] = 'usuario-existente';
						\header("Location:" . BASE_URL . "user/editar/?id=" . $id);
						exit;
					}
				} else {
					if ($nova_senha) {
						$passHash = \password_hash($nova_senha, PASSWORD_DEFAULT);
						$this->log_editar($_POST);
						$this->user->updateUserWithPass($username, $id_hospital, $perfil, $ativo, $passHash, $id);
					} else {
						$this->log_editar($_POST);
						$this->user->updateUser($username, $id_hospital, $perfil, $ativo, $id);
					}
					$_SESSION['msg'] = 'registro-alterado';
					\header("Location:" . BASE_URL . "user");
					exit;
				}
			}
		}
	}

	public function delete($id)
	{
		if ($this->user->infoUser()['perfil'] == 1 || $this->user->infoUser()['perfil'] == 2) {
			$id = intval(filter_input(INPUT_GET, 'id'));

			//registrando o log
			$usuario_logado = $this->user->infoUser();
			$dados_log = json_encode($_POST);

			$deletar = $this->user->delete($id);
			if ($deletar) {
				$_SESSION['msg'] = 'usuario-inativado';
				header("Location:" . BASE_URL . "user");
			}
		} else {
			$_SESSION['msg'] = 'usuario-inativado';
			header("Location:" . BASE_URL . "user");
			exit;
		}
	}

	public function ativar($id)
	{
		if ($this->user->infoUser()['perfil'] == 1 || $this->user->infoUser()['perfil'] == 2) {
			$id = intval(filter_input(INPUT_GET, 'id'));

			//registrando o log
			$usuario_logado = $this->user->infoUser();
			$dados_log = json_encode($_POST);

			$ativar = $this->user->activate($id);
			if ($ativar) {
				$_SESSION['msg'] = 'usuario-ativado';
				header("Location:" . BASE_URL . "user");
				exit;
			}
		} else {
			header("Location:" . BASE_URL . "user");
			exit;
		}
	}
}
