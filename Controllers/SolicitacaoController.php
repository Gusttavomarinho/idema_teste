<?php

namespace Controllers;

use \Core\Controller;
use \Models\Solicitacao;
use \Models\Processo;
use \Models\Users;
use \Models\Documento;
use \Mail\ServiceMail;

class SolicitacaoController extends Controller
{
	private $solicitacao;
	private $processo;
	private $documento;
	private $user;
	private $servicemail;

	public function __construct()
	{
		$this->solicitacao = new Solicitacao();
		$this->processo = new Processo();
		$this->documento = new Documento();
		$this->user = new Users();
		$this->servicemail = new ServiceMail();

		//verificar se esta logado
		if (!$this->user->verifyLogin()) {
			header("Location:" . BASE_URL . "login");
			exit;
		}
	}

	public function _validarperfil()
	{
		$perfil = $this->user->infoUser()['perfil'];
		if ($perfil != 1) {
			header("Location:" . BASE_URL . "home/sempermissao");
			exit;
		}
	}

	public function index()
	{
		////verificar se tem permissao
		$this->_validarperfil();
		//=======================
		$id_user = $this->user->infoUser()['id'];
		$dados['solicitacoes'] = $this->solicitacao->getAllPendente();
		$dados['solicitaoes_ultimas'] = $this->solicitacao->getUltimas();

		$this->loadTemplate('solicitacao/solicitacao', $dados);
	}

	public function criar()
	{
		$nome_usuario = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
		$email_usuario = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$processos = $_POST['processos'];
		$users_id = $this->user->infoUser()['id'];

		// $teste = $this->solicitacao->insertRegistroSolicitacao($solicitacao, 1);
		// print_r($teste);
		if ($solicitacao = $this->solicitacao->insert($nome_usuario, $email_usuario, $users_id)) {
			foreach ($processos as $key => $processo) {
				$this->solicitacao->insertRegistroSolicitacao($solicitacao, $processo);
				//print_r($key);
			}
			$anterior = $_SERVER['HTTP_REFERER'];
			header("location: {$anterior}");
			print_r('deu certo o cadastro de solicitação!');
		} else {
			print_r('deu errado o cadastro de solicitação!');
		}
	}

	public function validar()
	{
		////verificar se tem permissao
		$this->_validarperfil();
		//=======================
		$id_solicitacao = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		$user_id_solicitacao = $this->solicitacao->getbyID($id_solicitacao)['users_id'];
		$dados['solicitacao'] = $this->solicitacao->getbyID($id_solicitacao);
		$dados['user_solicitante'] = $this->user->getById($user_id_solicitacao)['username'];

		$this->loadTemplate('solicitacao/validar', $dados);
	}

	public function validar_action()
	{
		////verificar se tem permissao
		$this->_validarperfil();
		//=======================
		$email_usuario = filter_input(INPUT_POST, 'email_usuario');
		$solicitacao_id = filter_input(INPUT_POST, 'solicitacao_id');
		$usuario_aprovador = $_SESSION['global_user_info']['id'];
		$select_status = intval(filter_input(INPUT_POST, 'select_status'));

		$motivo = filter_input(INPUT_POST, 'motivo', FILTER_SANITIZE_STRING);

		// debugar
		// $teste = compact('email_usuario', 'solicitacao_id', 'usuario_aprovador', 'select_status', 'motivo');
		// print_r($teste);
		// exit;

		//montar o email para ser enviado
		$assunto_email = '[IDEMA] Alteração no Status da sua solicitação #' . $solicitacao_id;
		if ($select_status === 1) {
			$nome_status = 'APROVADO';
		} elseif ($select_status === 2) {
			$nome_status = 'REJEITADA';
		} else {
			$nome_status = 'STATUS INVALIDO';
		}

		$corpo_email = "Sua solicitação teve o status mudado para :{$nome_status}</p>
		<p>Motivo:{$motivo}</p> 
		<a href='http://linkparaacessardocumentos.com.br/?id={$solicitacao_id}'>Acessar Documentos</a>";
		if ($this->servicemail->enviarEmail($email_usuario, $assunto_email, $corpo_email)) {
			$this->solicitacao->togglestatus($solicitacao_id, $usuario_aprovador, $select_status, $motivo);
		} else {
			$this->solicitacao->togglestatus($solicitacao_id, $usuario_aprovador, 0, '');
			$_SESSION['semnet'] = '<div class="alert alert-danger" role="alert">
			Não Foi possivel enviar o email e alterar o status da solicitação , tente novamente!
		</div>';
			header("Location:" . BASE_URL . "solicitacao");
		}
	}

	public function verprocessos()
	{
		////verificar se tem permissao
		$this->_validarperfil();
		//=======================
		$id_solicitacao = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		$solicitacoes_processos = $this->solicitacao->getRegistroSolicitacao($id_solicitacao);
		foreach ($solicitacoes_processos as $key => $value) {
			$dados['processos'][$key] = $this->processo->getAllbyID($value['processos_id']);
			//pegando o id do usuario
			$users_id = $dados['processos'][$key]['users_id'];
			//mudando de id para nome
			$dados['processos'][$key]['users_id'] = $this->user->getById($users_id)['username'];
			//pegando o id dos processos
			$processos_id = $dados['processos'][$key]['id'];
			$dados['processos'][$key]['documentos_do_processo'][] = $this->documento->getAllbyProcessos($processos_id);
			//passando o codigo da solicitação
			$dados['id_solicitacao'] = $id_solicitacao;
		}
		// echo json_encode($dados['processos']);
		// exit;
		$this->loadTemplate('solicitacao/processos', $dados);
	}

	public function versolicitacao()
	{
		////verificar se tem permissao
		$this->_validarperfil();
		//=======================
		$id_solicitacao = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		$user_id_solicitacao = $this->solicitacao->getbyID($id_solicitacao)['users_id'];
		$dados['solicitacao'] = $this->solicitacao->getbyID($id_solicitacao);
		$dados['user_solicitante'] = $this->user->getById($user_id_solicitacao)['username'];
		$id_user_que_aprovou = $this->solicitacao->getbyID($id_solicitacao)['user_id_aprovacao'];
		$user_que_aprovou = $this->user->getById($id_user_que_aprovou)['username'];
		if ($user_que_aprovou != null) {
			$dados['username_aprovacao'] = $user_que_aprovou;
		}

		$this->loadTemplate('solicitacao/versolicitacao', $dados);
	}
}
