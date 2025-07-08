<?php
require_once __DIR__ . '/../views/includes/db.php';


class User {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    /**
     * Récupère un utilisateur par son login
     */
    public function findByLogin(string $login): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE login = :login LIMIT 1');
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    /**
     * Crée un nouvel utilisateur (par ex. depuis l’admin)
     */
    public function create(string $login, string $password, string $role = 'visitor'): bool {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare('INSERT INTO users (login, password_hash, role) VALUES (:login, :hash, :role)');
        return $stmt->execute([
            'login' => $login,
            'hash'  => $hash,
            'role'  => $role
        ]);
    }

   public function all() {
    $stmt = $this->pdo->query("SELECT id, login, role FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function update($id, $login, $role) {
        $stmt = $this->pdo->prepare("UPDATE users SET login = ?, role = ? WHERE id = ?");
        return $stmt->execute([$login, $role, $id]);
    }

}
