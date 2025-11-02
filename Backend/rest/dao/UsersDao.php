<?php
require_once 'BaseDao.php';

class UsersDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "users";
        parent::__construct($this->table_name);
    }

    public function getByIdLocal($user_id) {
        return parent::getById($user_id, 'user_id');
    }

    public function deleteById($user_id) {
        return parent::delete($user_id, 'user_id');
    }

    public function getByEmail($email) {
        return $this->findOneBy(['email' => $email]);
    }

    public function insertUsers($entity){
        return $this->add($entity);
    }

    public function updateUsers($entity, $id, $id_column = "id"){
        return $this->update($entity, $id, $id_column = "id");
    }

}
?>

