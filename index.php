<?php
session_start();
function autoload($className) {
    $file = '/controllers/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('autoload');


// Routing basique
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$publicControllers = ['auth'];
if (
    !in_array($controller, $publicControllers) 
    && empty($_SESSION['user_id'])
) {
    // redirige vers le login si pas connecté
    header('Location: ?controller=auth&action=login');
    exit;
}

switch ($controller) {
    case 'auth':
        require_once './app/controllers/authController.php';
        $authController = new AuthController();
        switch ($action) {
            case 'login':
                $authController->login();
                break;
            case 'authenticate':
                $authController->authenticate();
                break;
            case 'register':
                $authController->register();
                break;
            case 'store':
                $authController->store();
                break;
            case 'logout':
                $authController->logout();
                break;
            default:
                http_response_code(404);
                require_once './app/views/404.php';
        }
        break;
    case 'home':
        require_once './app/controllers/homeController.php';
        $homeController = new HomeController();
        $homeController->index();
        break;
    case 'article':
        require_once './app/controllers/articleController.php';
        $articleController = new ArticleController();
        $articleController->show($id);
        break;
    case 'categorie':
        require_once './app/controllers/categorieController.php';
        $categorieController = new CategorieController();
        $categorieController->index($id);
        break;
    default:
        http_response_code(404);
        require_once './app/views/404.php';
        break;
}
?>