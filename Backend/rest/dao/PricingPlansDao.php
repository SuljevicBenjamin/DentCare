<?php
require_once 'BaseDao.php';

class PricingPlansDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "pricing_plans";
        parent::__construct($this->table_name);
    }

    public function getByIdLocal($plan_id) {
        return parent::getById($plan_id, 'plan_id');
    }

    public function deleteById($plan_id) {
        return parent::delete($plan_id, 'plan_id');
    }

    public function insertPricingPlans($entity){
        return $this->add($entity);
    }

    public function updatePricingPlans($entity, $id, $id_column = "id"){
        return $this->update($entity, $id, $id_column = "id");
    }

}
?>

