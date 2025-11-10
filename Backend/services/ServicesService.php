<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ServicesDao.php';


    class ServicesService extends BaseService {
        public function __construct() {
            $dao = new ServicesDao();
            parent::__construct($dao);
        }

    public function getAllServices() {
        return $this->dao->getAll();
    }

    public function getServiceById($service_id) {
        $service = $this->dao->getByIdLocal($service_id);
        if (!$service) {
            throw new Exception("Service not found");
        }
        return $service;
    }

    public function getServiceByName($name) {
        return $this->dao->getByName($name);
    }

    public function addService($data) {
        return $this->dao->insertServices($data);
    }

    public function updateService($service_id, $data) {
        $existing = $this->dao->getByIdLocal($service_id);
        if (!$existing) {
            throw new Exception("Service not found");
        }
        return $this->dao->updateServices($data, $service_id, 'service_id');
    }

    public function deleteService($service_id) {
        $existing = $this->dao->getByIdLocal($service_id);
        if (!$existing) {
            throw new Exception("Service not found");
        }
        return $this->dao->deleteById($service_id);
    }
}
?>

