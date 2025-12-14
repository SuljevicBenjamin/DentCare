<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UsersDao.php';

class UsersService extends BaseService {
    public function __construct() {
        $dao = new UsersDao();
        parent::__construct($dao);
    }

    public function getAllUsers() {
        $users = $this->dao->getAll();
        foreach ($users as &$user) {
            unset($user['password']);
        }
        return $users;
    }

    public function getUserById($user_id) {
        $user = $this->dao->getByIdLocal($user_id);
        if (!$user) {
            throw new Exception("User not found");
        }
        unset($user['password']);
        return $user;
    }
    
    public function getUserByEmail($email) {
        return $this->dao->getByEmail($email);
    }

    public function addUser($data) {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $result = $this->dao->insertUsers($data);
        unset($result['password']);
        return $result;
    }

    public function updateUser($user_id, $data) {
        $existing = $this->dao->getByIdLocal($user_id);
        if (!$existing) {
            throw new Exception("User not found");
        }
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $result = $this->dao->updateUsers($data, $user_id, 'user_id');
        if (isset($result['password'])) {
            unset($result['password']);
        }
        return $result;
    }

    public function deleteUser($user_id) {
        $existing = $this->dao->getByIdLocal($user_id);
        if (!$existing) {
            throw new Exception("User not found");
        }
        return $this->dao->deleteById($user_id);
    }
}
?>

