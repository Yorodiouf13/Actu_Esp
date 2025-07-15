<?php
require_once __DIR__ . '/../models/user.php';

class SoapUserService
{
    private $tokenValid = "1234567890SECRET"; 

    private function checkToken($token)
    {
        if ($token !== $this->tokenValid) {
            throw new SoapFault("Client", "Token invalide ou manquant");
        }
    }

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
        $this->checkToken($token);

        $userModel = new User();
        return $userModel->all(); 
    }

    public function addUser($token, $login, $password, $role = "visitor")
    {
        $this->checkToken($token);

        $userModel = new User();
        return $userModel->create($login, $password, $role);
    }

    public function deleteUser($token, $id)
    {
        $this->checkToken($token);

        $userModel = new User();
        return $userModel->delete($id); 
    }

    public function updateUser($token, $id, $login, $role)
    {
        $this->checkToken($token);

        $userModel = new User();
        return $userModel->update($id, $login, $role); 
    }
}
?>
