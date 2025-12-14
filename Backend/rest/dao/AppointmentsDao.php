<?php
require_once 'BaseDao.php';

class AppointmentsDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "appointments";
        parent::__construct($this->table_name);
    }

    public function getByIdLocal($appointment_id) {
        return parent::getById($appointment_id, 'appointment_id');
    }

    public function deleteById($appointment_id) {
        return parent::delete($appointment_id, 'appointment_id');
    }

    public function getByUser($user_id) {
        return $this->findBy(['user_id' => $user_id]);
    }

    public function getByDentistAndDate($dentist_id, $appointment_date) {
        return $this->findBy(['dentist_id' => $dentist_id, 'appointment_date' => $appointment_date]);
    }

    public function insertAppointment($entity){
        return $this->add($entity);
    }

    public function updateAppointment($entity, $id, $id_column = "id"){
        return $this->update($entity, $id, $id_column);
    }

}
?>

