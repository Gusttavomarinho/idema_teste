<?php

namespace Models;

use Core\Model;
use Models\Hospital;

class Users extends Model
{
  private $uid;

  public function verifyLogin()
  {
    if (!empty($_SESSION['hashlogin'])) {
      $s = $_SESSION['hashlogin'];
      $sql = "SELECT id FROM users WHERE loginhash=:hash AND ativo=1";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':hash', $s);
      $sql->execute();

      if ($sql->rowCount() > 0) {
        $data = $sql->fetch();
        $this->uid = $data['id'];
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function getAll()
  {
    try {
      $sql = "SELECT users.id, username, perfil, hospitais.nome AS hospital, image, users.ativo, create_at, update_at, deleted_at
            FROM users
            INNER JOIN hospitais
            ON hospitais.id = id_hospital";
      $sql = $this->db->prepare($sql);
      $sql->execute();
      if ($sql->rowCount() > 0) {
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
      }
    } catch (\PDOException $error) {
      echo "ERROR" . $error->getMessage();
    }
  }

  public function getById($id)
  {
    try {
      $sql = "SELECT * FROM users WHERE id = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $id);
      $sql->execute();
      if ($sql->rowCount() > 0) {
        return $sql->fetch(\PDO::FETCH_ASSOC);
      }
    } catch (\PDOException $error) {
      echo "ERROR" . $error->getMessage();
    }
  }

  public function validateUsername($u)
  {
    if (preg_match('/^[a-z0-9]+$/', $u)) {
      return true;
    } else {
      return false;
    }
  }

  public function userExists($u)
  {
    $sql = "SELECT * FROM users WHERE username=:u";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':u', $u);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function userRegister($username, $pass)
  {
    $passHash = \password_hash($pass, PASSWORD_DEFAULT);
    $primeiro_insert = date('Y-m-d H:i:s');
    $sql = "INSERT INTO users(username, pass, ativo, create_at, update_at,perfil)VALUES(:user, :pass, 1, :create, :update, 2)";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':user', $username);
    $sql->bindValue(':pass', $passHash);
    $sql->bindValue(':create', $primeiro_insert);
    $sql->bindValue(':update', $primeiro_insert);
    $sql->execute();
  }

  public function validateUser($username, $pass)
  {
    try {
      $sql = "SELECT * FROM users WHERE username = :u";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':u', $username);
      $sql->execute();
      if ($sql->rowCount() > 0) {
        $info = $sql->fetch(\PDO::FETCH_ASSOC);
        if (password_verify($pass, $info['pass'])) {
          $loginhash = md5(rand(0, 9999) . time() . $info['id'] . $info['username']);
          $this->setLoginHash($info['id'], $loginhash);
          $_SESSION['hashlogin'] = $loginhash;
          $_SESSION['info_id'] = $info['id'];
          $_SESSION['perfil'] = $info['perfil'];
          $_SESSION['ativo'] = $info['ativo'];
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } catch (\PDOException $error) {
      echo $error;
    }
  }

  public function getUser()
  {
    return $this->uid;
  }

  public function infoUser()
  {
    try {
      if (isset($_SESSION['info_id'])) {
        $sql = "SELECT * FROM users WHERE id=:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $_SESSION['info_id']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
          return $sql->fetch(\PDO::FETCH_ASSOC);
        } else {
          return false;
        }
      }
    } catch (\PDOException $error) {
      echo $error->getMessage();
    }
  }

  public function updateUser($username, $id_hospital, $perfil, $ativo, $id)
  {
    try {
      $sql = "UPDATE users SET username=:username, id_hospital=:id_hospital, perfil=:perfil, ativo=:ativo, update_at=:updated WHERE id=:id";
      $updated = date('Y-m-d H:i:s');
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':username', $username);
      $sql->bindValue(':id_hospital', $id_hospital);
      $sql->bindValue(':perfil', $perfil);
      $sql->bindValue(':ativo', $ativo);
      $sql->bindValue(':updated', $updated);
      $sql->bindValue(':id', $id);
      $sql->execute();
    } catch (\PDOException $error) {
      echo $error->getMessage();
    }
  }

  public function updateUserWithPass($username, $id_hospital, $perfil, $ativo, $pass, $id)
  {
    try {
      $sql = "UPDATE users SET username=:username, id_hospital=:id_hospital, perfil=:perfil, ativo=:ativo, pass=:pass, update_at=:updated WHERE id=:id";
      $updated = date('Y-m-d H:i:s');
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':username', $username);
      $sql->bindValue(':id_hospital', $id_hospital);
      $sql->bindValue(':perfil', $perfil);
      $sql->bindValue(':ativo', $ativo);
      $sql->bindValue(':pass', $pass);
      $sql->bindValue(':updated', $updated);
      $sql->bindValue(':id', $id);
      $sql->execute();
    } catch (\PDOException $error) {
      echo $error->getMessage();
    }
  }

  private function setLoginHash($uid, $hash)
  {
    try {
      $sql = "UPDATE users SET loginhash=:hash WHERE id=:id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':hash', $hash);
      $sql->bindValue(':id', $uid);
      $sql->execute();
    } catch (\PDOException $error) {
      echo $error->getMessage();
    }
  }

  public function delete($id)
  {
    try {
      $sql = "UPDATE users SET ativo=0, update_at=:updated, deleted_at=:deleted WHERE id=:id";
      $updated = date('Y-m-d H:i:s');
      $deleted = $updated;
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':updated', $updated);
      $sql->bindValue(':deleted', $deleted);
      $sql->bindValue(':id', $id);
      $sql->execute();
      return true;
    } catch (\PDOException $error) {
      echo $error->getMessage();
      return false;
    }
  }

  public function activate($id)
  {
    try {
      $sql = "UPDATE users SET ativo=1, update_at=:updated WHERE id=:id";
      $updated = date('Y-m-d H:i:s');
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':updated', $updated);
      $sql->bindValue(':id', $id);
      $sql->execute();
      return true;
    } catch (\PDOException $error) {
      echo $error->getMessage();
      return false;
    }
  }

  public function logs($id_usuario, $atividade, $dados)
  {
    $ip_usuario = $_SERVER['REMOTE_ADDR'];
    if ($atividade == 'editado' || $atividade == 'deletado') {
      $id_buscar = json_decode($dados);
      $dados_antigo = $this->getById($id_buscar->id);
      $dados = 'dados_antigos: ' . json_encode($dados_antigo);
    }

    try {
      $sql = "INSERT INTO logs (ip_usuario,id_usuario,atividade,tabela,dados) VALUES(:ip_usuario,:id_usuario,:atividade,:tabela,:dados)";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':ip_usuario', $ip_usuario);
      $sql->bindValue(':id_usuario', $id_usuario);
      $sql->bindValue(':atividade', $atividade);
      $sql->bindValue(':tabela', 'users');
      $sql->bindValue(':dados', $dados);
      $sql->execute();
      return true;
    } catch (\PDOException $error) {
      echo "ERROR" . $error->getMessage();
      return false;
    }
  }
}

/* LISTA DE PERFIL */
// PERFIL 1 = ADMIN
// PERFIL 2 = GERENTE 
// PERFIL 3 = USUARIO
