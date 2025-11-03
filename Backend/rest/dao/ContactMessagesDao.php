<?php
require_once 'BaseDao.php';

class ContactMessagesDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "contact_messages";
        parent::__construct($this->table_name);
    }

    public function getByIdLocal($message_id) {
        return parent::getById($message_id, 'message_id');
    }

    public function deleteById($message_id) {
        return parent::delete($message_id, 'message_id');
    }

    public function insertContactMessages($entity){
        return $this->add($entity);
    }

    public function updateContactMessages($entity, $id, $id_column = "id"){
        return $this->update($entity, $id, $id_column = "id");
    }

}
?>

