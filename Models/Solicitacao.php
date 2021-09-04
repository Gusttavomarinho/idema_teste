<?php

namespace Models;

use \Core\Model;


class Solicitacao extends Model
{

    public function getAll()
    {
        $array = array();

        try {
            $sql = "SELECT * FROM solicitacoes";
            $sql = $this->db->prepare($sql);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return  $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\Exception $e) {
            return $array['error'] = $e->getMessage();
        }

        return $array;
    }

    public function getAllPendente()
    {
        $array = array();

        try {
            $sql = "SELECT * FROM solicitacoes where status_aprovacao='0'";
            $sql = $this->db->prepare($sql);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return  $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\Exception $e) {
            return $array['error'] = $e->getMessage();
        }

        return $array;
    }

    public function getUltimas()
    {
        $array = array();

        try {
            $sql = "SELECT * FROM solicitacoes ORDER BY data DESC limit 50";
            $sql = $this->db->prepare($sql);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return  $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\Exception $e) {
            return $array['error'] = $e->getMessage();
        }

        return $array;
    }

    public function getAllbyuser($id)
    {
        $array = array();

        try {
            $sql = "SELECT * FROM solicitacoes where users_id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return  $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\Exception $e) {
            return $array['error'] = $e->getMessage();
        }



        return $array;
    }

    public function getbyID($id)
    {
        $array = array();

        try {
            $sql = "SELECT * FROM solicitacoes where id=:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return  $array = $sql->fetch(\PDO::FETCH_ASSOC);
            }
        } catch (\Exception $e) {
            return $array['error'] = $e->getMessage();
        }



        return $array;
    }

    public function insert($nome_usuario, $email_usuario, $users_id)
    {
        $array = array();
        $data = date('Y-m-d G:i:s');
        // print_r($data);
        // exit;

        try {
            $sql = "INSERT INTO solicitacoes( nome_usuario, 
                email_usuario, data, users_id) 
                VALUES (:nome_usuario,:email_usuario,:data,:users_id)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':nome_usuario', $nome_usuario);
            $sql->bindValue(':email_usuario', $email_usuario);
            $sql->bindValue(':data', $data);
            $sql->bindValue(':users_id', $users_id);
            $sql->execute();
            return $this->db->lastInsertId();
        } catch (\Exception $e) {
            echo $array['error'] = $e->getMessage();
            return false;
        }



        return $array;
    }

    public function insertRegistroSolicitacao($solicitacoes_id, $processos_id)
    {


        try {
            $sql = "INSERT INTO solicitacoes_has_processos( 
                solicitacoes_id, processos_id) 
                VALUES (:solicitacoes_id,:processos_id)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':solicitacoes_id', $solicitacoes_id);
            $sql->bindValue(':processos_id', $processos_id);
            $sql->execute();
            return true;
        } catch (\Exception $e) {
            echo $array['error'] = $e->getMessage();
            return false;
        }



        return $array;
    }

    public function getRegistroSolicitacao($solicitacoes_id)
    {


        try {
            $sql = "SELECT * FROM  solicitacoes_has_processos where solicitacoes_id=:solicitacoes_id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':solicitacoes_id', $solicitacoes_id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return  $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\Exception $e) {
            echo $array['error'] = $e->getMessage();
            return false;
        }



        return $array;
    }

    public function togglestatus($id_solicitacao, $user_id_aprovacao, $status_aprovacao, $status_motivo)
    {
        $data_aprovacao = date('Y-m-d G:i:s');

        try {
            $sql = "UPDATE solicitacoes SET 
            data_aprovacao=:data_aprovacao,
            user_id_aprovacao=:user_id_aprovacao,
            status_aprovacao=:status_aprovacao , status_motivo=:status_motivo WHERE id=:id_solicitacao";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id_solicitacao', $id_solicitacao);
            $sql->bindValue(':data_aprovacao', $data_aprovacao);
            $sql->bindValue(':user_id_aprovacao', $user_id_aprovacao);
            $sql->bindValue(':status_aprovacao', $status_aprovacao);
            $sql->bindValue(':status_motivo', $status_motivo);
            $sql->execute();
            return true;
        } catch (\Exception $e) {
            echo $array['error'] = $e->getMessage();
            return false;
        }



        return $array;
    }
}
