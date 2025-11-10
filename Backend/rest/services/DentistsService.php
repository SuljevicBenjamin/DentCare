<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/DentistsDao.php';

class DentistsService extends BaseService {
    public function __construct() {
        $dao = new DentistsDao();
        parent::__construct($dao);
    }

    public function getAllDentists() {
        return $this->dao->getAll();
    }

    public function getDentistById($dentist_id) {
        $dentist = $this->dao->getByIdLocal($dentist_id);
        if (!$dentist) {
            throw new Exception("Dentist not found");
        }
        return $dentist;
    }

    public function getDentistsBySpecialization($specialization) {
        return $this->dao->getBySpecialization($specialization);
    }

    public function addDentist($data) {
        return $this->dao->insertDentists($data);
    }

    public function updateDentist($dentist_id, $data) {
        $existing = $this->dao->getByIdLocal($dentist_id);
        if (!$existing) {
            throw new Exception("Dentist not found");
        }
        return $this->dao->updateDentists($data, $dentist_id, 'dentist_id');
    }

    public function deleteDentist($dentist_id) {
        $existing = $this->dao->getByIdLocal($dentist_id);
        if (!$existing) {
            throw new Exception("Dentist not found");
        }
        return $this->dao->deleteById($dentist_id);
    }
}
?>

