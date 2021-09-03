<?php

namespace Models;

use \Core\Model;


class Processo extends Model
{

    public function getAll()
    {
        $array = array();

        try {
            $sql = "SELECT * FROM processos";
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
            $sql = "SELECT * FROM processos where users_id=:id";
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
}
