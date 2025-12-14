<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/PricingPlansDao.php';

class PricingPlansService extends BaseService {
    public function __construct() {
        $dao = new PricingPlansDao();
        parent::__construct($dao);
    }

    public function getAllPricingPlans() {
        return $this->dao->getAll();
    }

    public function getPricingPlanById($plan_id) {
        $plan = $this->dao->getByIdLocal($plan_id);
        if (!$plan) {
            throw new Exception("Pricing plan not found");
        }
        return $plan;
    }

    public function addPricingPlan($data) {
        return $this->dao->insertPricingPlans($data);
    }

    public function updatePricingPlan($plan_id, $data) {
        $existing = $this->dao->getByIdLocal($plan_id);
        if (!$existing) {
            throw new Exception("Pricing plan not found");
        }
        return $this->dao->updatePricingPlans($data, $plan_id, 'plan_id');
    }

    public function deletePricingPlan($plan_id) {
        $existing = $this->dao->getByIdLocal($plan_id);
        if (!$existing) {
            throw new Exception("Pricing plan not found");
        }
        return $this->dao->deleteById($plan_id);
    }
}
?>

