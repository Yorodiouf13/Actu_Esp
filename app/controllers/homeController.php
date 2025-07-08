<?php
require_once 'app/models/article.php';
require_once 'app/models/categorie.php';

class HomeController {
    public function index() {
   $articleModel = new Article();
    $categorieModel = new Categorie();

    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $perPage = 5;

    $total = $articleModel->countAll();
    $articles = $articleModel->getPaginatedArticles($page, $perPage);

    $totalPages = max(1, ceil($total / $perPage));

    require_once 'app\views\home.php';
}

}