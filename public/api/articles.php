<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../app/models/article.php';
require_once __DIR__ . '/../../app/models/categorie.php';

$articleModel = new Article();
$categorieModel = new Categorie();

// Utilisation des paramètres GET pour router les requêtes
$endpoint = isset($_GET['endpoint']) ? $_GET['endpoint'] : '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($endpoint) {
    case 'articles':
        $articles = $articleModel->getAllArticles();
        echo json_encode($articles);
        exit;

    case 'articles_by_category':
        if ($id) {
            $articles = $articleModel->getArticlesByCategory($id);
            echo json_encode($articles);
            exit;
        }
        break;

    case 'categories':
        $categories = $categorieModel->getAllCategoriesWithArticles();
        echo json_encode($categories);
        exit;
}

http_response_code(404);
echo json_encode(['error' => 'Not found']);
exit;
