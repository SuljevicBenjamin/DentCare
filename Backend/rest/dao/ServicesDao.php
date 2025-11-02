<?php
require_once 'BaseDao.php';

class ServicesDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "services";
        parent::__construct($this->table_name);
    }

    public function getByIdLocal($service_id) {
        return parent::getById($service_id, 'service_id');
    }

    public function deleteById($service_id) {
        return parent::delete($service_id, 'service_id');
    }

    public function getByName($name) {
        return $this->findOneBy(['name' => $name]);
    }

    public function insertServices($entity){
        return $this->add($entity);
    }

    public function updateServices($entity, $id, $id_column = "id"){
        return $this->update($entity, $id, $id_column = "id");
    }

}
?>

