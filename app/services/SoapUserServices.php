<?php
require_once __DIR__ . '/../models/user.php';


class SoapUserService
{
    private $tokenValid = "1234567890SECRET"; // À remplacer par vraie gestion de tokens

    public function authenticate($login, $password)
    {
        $userModel = new User();
        $user = $userModel->findByLogin($login);
        if ($user && password_verify($password, $user['password_hash'])) {
            return [
                'success' => true,
                'role' => $user['role'],
                'id' => $user['id']
            ];
        }
        return ['success' => false];
    }

    public function listUsers($token)
    {
        if ($token !== $this->tokenValid) {
            return [];
        }
        $userModel = new User();
        return $userModel->all(); 
    }

    public function addUser($token, $login, $password, $role = "visitor")
    {
        if ($token !== $this->tokenValid) {
            return false;
        }
        $userModel = new User();
        return $userModel->create($login, $password, $role);
    }

    public function deleteUser($token, $id)
    {
        if ($token !== $this->tokenValid) {
            return false;
        }
        $userModel = new User();
        return $userModel->delete($id); // À implémenter dans User.php
    }

    public function updateUser($token, $id, $login, $role)
    {
        if ($token !== $this->tokenValid) {
            return false;
        }
        $userModel = new User();
        return $userModel->update($id, $login, $role); // À implémenter dans User.php
    }
}
?>
