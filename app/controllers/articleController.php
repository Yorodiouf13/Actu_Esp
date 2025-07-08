<?php
require_once 'app\models\article.php';

class ArticleController {
    public function show($id) {
        $articleModel = new Article();
        $article = $articleModel->getArticleById($id);
        if (!$article) {
            http_response_code(404);
            require_once 'app\views\404.php';
            return;
        }
        require_once 'app\views\article.php';
    }
}

