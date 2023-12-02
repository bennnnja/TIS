<?php
class PersonasModel extends Query{
    public function __construct(){

        parent::__construct();

        }
    public function getPersona(){
        
        $sql = "SELECT * FROM persona";
        $data = $this->select($sql);
        return $data;
         }
        
}
?>