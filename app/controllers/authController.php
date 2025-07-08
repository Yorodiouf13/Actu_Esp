<?php

require_once 'app\models\user.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    /**
     * Affiche le formulaire de login
     */
    public function login(): void {
        require __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Traite la soumission du formulaire
     */
    public function authenticate(): void {
        $login    = $_POST['login']    ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByLogin($login);
        if ($user && password_verify($password, $user['password_hash'])) {
            // Succès : on stocke l’ID et le rôle
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role']    = $user['role'];
            
            if ($_SESSION['role'] === 'admin') {
                header('Location: ?controller=admin&action=index');
            } else {
                header('Location: ?controller=home&action=index');
            }
            exit;
        }

        // Échec
        $error = 'Login ou mot de passe incorrect';
        require __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Déconnexion
     */
    public function logout(): void {
        session_unset();
        session_destroy();
        require __DIR__ . '/../views/auth/login.php';
        exit;
    }

    public function register() {
    require __DIR__ . '/../views/auth/register.php';
    }

    public function store() {
        $login    = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm'] ?? '';
        $error    = '';

        if ($password !== $confirm) {
            $error = "Les mots de passe ne correspondent pas.";
            require __DIR__ . '/../views/auth/register.php';
            return;
        }

        // Vérifier si le login existe déjà
        if ($this->userModel->findByLogin($login)) {
            $error = "Ce login existe déjà.";
            require __DIR__ . '/../views/auth/register.php';
            return;
        }

        // Création du compte
        if ($this->userModel->create($login, $password)) {
            // Connexion automatique après inscription (optionnel)
            $user = $this->userModel->findByLogin($login);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: ?controller=auth&action=login');
            exit;
        } else {
            $error = "Erreur lors de la création du compte.";
            require __DIR__ . '/../views/auth/register.php';
        }
    }



}
