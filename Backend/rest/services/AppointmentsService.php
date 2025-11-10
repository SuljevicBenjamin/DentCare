<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/AppointmentsDao.php';


    class AppointmentsService extends BaseService {
        public function __construct() {
            $dao = new AppointmentsDao();
            parent::__construct($dao);
        }

    public function getAllAppointments() {
        return $this->dao->getAll();
    }

    public function getAppointmentById($appointment_id) {
        $appointment = $this->dao->getByIdLocal($appointment_id);
        if (!$appointment) {
            throw new Exception("Appointment not found");
        }
        return $appointment;
    }

    public function getAppointmentsByUser($user_id) {
        return $this->dao->getByUser($user_id);
    }

    public function getAppointmentsByDentistAndDate($dentist_id, $appointment_date) {
        return $this->dao->getByDentistAndDate($dentist_id, $appointment_date);
    }

    public function addAppointment($data) {
        return $this->dao->insertAppointment($data);
    }

    public function updateAppointment($appointment_id, $data) {
        $existing = $this->dao->getByIdLocal($appointment_id);
        if (!$existing) {
            throw new Exception("Appointment not found");
        }
        return $this->dao->updateAppointment($data, $appointment_id, 'appointment_id');
    }

    public function deleteAppointment($appointment_id) {
        $existing = $this->dao->getByIdLocal($appointment_id);
        if (!$existing) {
            throw new Exception("Appointment not found");
        }
        return $this->dao->deleteById($appointment_id);
    }
}
?>

