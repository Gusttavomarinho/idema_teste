<?php

namespace Controllers;

use \Core\Controller;
use Models\Hospital;
use \Models\Users;
use \Utils\Inputs;

class LoginController extends Controller
{
  public function index()
  {
    $dados = [
      'msg' => '',
      'error' => ''
    ];
    if (!empty($_GET['error'])) {
      if ($_GET['error'] == '1') {
        $_SESSION['msg'] = '<div class="col mb-4"><span class="alert alert-danger" id="msg_corpo">Usuário e/ou senha inválidos!</span></div>';
      } else if ($_GET['error'] == '2') {
        $_SESSION['msg'] = '<div class="col mb-4"><span class="alert alert-danger" id="msg_corpo">O usuário não existe ou não está ativo!</span></div>';
      }
    }
    $this->loadView('login/login', $dados);
  }

  public function signin()
  {

    if (!empty($_POST['username'])) {
      $username = \strtolower($_POST['username']);
      if (!empty($_POST['pass'])) {
        $pass = $_POST['pass'];
      } else {
        $_SESSION['msg'] = 'sem-senha';
        \header('Location:' . BASE_URL . 'login');
        exit;
      }

      $user = new Users;
      if (!$user->userExists($username)) {
        $_SESSION['msg'] = 'usuario-inexistente';
        \header('Location:' . BASE_URL . 'login');
        exit;
      }
      if ($user->validateUser($username, $pass)) {
        if ($user->infoUser()['ativo'] == '0') {  // Usuário inativo
          $_SESSION['msg'] = 'usuario-inativo';
          \header('Location:' . BASE_URL . 'login');
          exit;
        }
        $_SESSION['user_info'] = $user->infoUser(); // OK
        $_SESSION['msg'] = 'usuario-logado';
        \header('Location:' . BASE_URL);
        exit;
      } else {                                    // Usuário e senha não batem
        $_SESSION['msg'] = 'usuario-senha-erro';
        \header('Location:' . BASE_URL . 'login');
        exit;
      }
    } else {                                      // Sem username
      $_SESSION['msg'] = 'sem-username';
      \header('Location:' . BASE_URL . 'login');
      exit;
    }
  }

  public function signup()
  {
    $dados = [
      'msg' => '',
      'error' => ''
    ];
    if (isset($_POST['btn-acessar'])) {
      if (!empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['pass_confirm'])) {
        unset($_POST['msg']);
        $username = \strtolower(filter_input(INPUT_POST, 'username'));
        $pass = filter_input(INPUT_POST, 'pass');
        $passConfirm = filter_input(INPUT_POST, 'pass_confirm');
        if ($pass !== $passConfirm) {
          $_SESSION['msg'] = 'senhas-diferentes';
        } else {
          $user = new Users;
          if ($user->validateUsername($username)) {
            if (!$user->userExists($username)) {
              $user->userRegister($username, $pass);
              $_SESSION['msg'] = 'usuario-criado';
              \header("Location:" . BASE_URL . "login");
              exit;
            } else {
              $_SESSION['msg'] = 'usuario-existente';
            }
          } else {
            $_SESSION['msg'] = 'usuario-invalido';
          }
        }
      } else {
        $_SESSION['msg'] = 'obrigatorios';
      }
    }
    $this->loadView('login/signup', $dados);
  }
}
