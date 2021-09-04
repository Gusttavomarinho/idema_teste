<?php

namespace Models;

use \Core\Model;


class Documento extends Model
{

    public function getAll()
    {
        $array = array();

        try {
            $sql = "SELECT * FROM documentos";
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

    public function getAllbyProcessos($id)
    {
        $array = array();

        try {
            $sql = "SELECT * FROM documentos where processos_id=:id";
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

    public function getAllbyID($id)
    {
        $array = array();

        try {
            $sql = "SELECT * FROM documentos where id=:id";
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
}
