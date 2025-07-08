<?php
require_once 'app/models/article.php';
require_once 'app/models/categorie.php';

class CategorieController {
    public function index($id) {
        $categoryModel = new Categorie();
        $articleModel = new Article();

        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $perPage = 5;

        // Récupérer le nom de la catégorie
        $category = $categoryModel->getCategoryById($id);
        $articles = $articleModel->getArticlesByCategory($id);
        if (!$category) {
            http_response_code(404);
            require_once 'app/views/404.php';
            return;
        }

        $total = $articleModel->countAll($id);
        $articles = $articleModel->getPaginatedArticles($page, $perPage, $id);

        $totalPages = max(1, ceil($total / $perPage));

        require_once 'app/views/categorie.php';
    }
}

?>