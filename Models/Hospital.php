<?php
namespace Models;

use \Core\Model;


class Hospital extends Model {

	public function getAll() {
        $array = array();

        try{
            $sql = "SELECT * FROM hospitais";
            $sql = $this->db->prepare($sql);
            $sql->execute();

            if($sql->rowCount() > 0) {
                return  $array=$sql->fetchAll(\PDO::FETCH_ASSOC);
            }

        }catch(Exception $e){
            return $array['error'] = $e->getMessage();
        }

        

		return $array;
	}

}