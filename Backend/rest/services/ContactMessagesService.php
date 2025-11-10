<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ContactMessagesDao.php';

class ContactMessagesService extends BaseService {
    public function __construct() {
        $dao = new ContactMessagesDao();
        parent::__construct($dao);
    }

    public function getAllContactMessages() {
        return $this->dao->getAll();
    }

    public function getContactMessageById($message_id) {
        $message = $this->dao->getByIdLocal($message_id);
        if (!$message) {
            throw new Exception("Contact message not found");
        }
        return $message;
    }

    public function addContactMessage($data) {
        return $this->dao->insertContactMessages($data);
    }

    public function updateContactMessage($message_id, $data) {
        $existing = $this->dao->getByIdLocal($message_id);
        if (!$existing) {
            throw new Exception("Contact message not found");
        }
        return $this->dao->updateContactMessages($data, $message_id, 'message_id');
    }

    public function deleteContactMessage($message_id) {
        $existing = $this->dao->getByIdLocal($message_id);
        if (!$existing) {
            throw new Exception("Contact message not found");
        }
        return $this->dao->deleteById($message_id);
    }
}
?>

