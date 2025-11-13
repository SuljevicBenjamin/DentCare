<?php
require_once 'BaseDao.php';

class DentistsDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "dentists";
        parent::__construct($this->table_name);
    }

    public function getByIdLocal($dentist_id) {
        return parent::getById($dentist_id, 'dentist_id');
    }

    public function deleteById($dentist_id) {
        return parent::delete($dentist_id, 'dentist_id');
    }

    public function getBySpecialization($specialization) {
        return $this->findBy(['specialization' => $specialization]);
    }

    public function insertDentists($entity){
        return $this->add($entity);
    }

    public function updateDentists($entity, $id, $id_column = "id"){
        return $this->update($entity, $id, $id_column);
    }

}
?>

