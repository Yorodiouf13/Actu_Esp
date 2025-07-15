<?php
require_once __DIR__ . '/../models/article.php';

class EditorController {
    private $articleModel;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'editor') {
            header("Location: /login.php");
            exit;
        }
        $this->articleModel = new Article();
    }

    // Dashboard : liste des articles de l'éditeur
    public function dashboard() {
        $articles = $this->articleModel->getArticlesByAuthor($_SESSION['user_id']);
        require __DIR__ . '/../views/editor.php';
    }

    // Affiche le formulaire de création
    public function create() {
        require __DIR__ . '/../views/editorCreate.php';
    }

    // Traite la création
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $categoryId = intval($_POST['category_id']);

            $this->articleModel->create($title, $content, $_SESSION['user_id'], $categoryId);

            header("Location: ?controller=editor&action=index");
            exit;
        }
    }

    // Affiche le formulaire d'édition
    public function edit($id) {
        $article = $this->articleModel->getArticleById($id);

        // sécurité : s'assurer que l'article appartient à l'éditeur
        if (!$article || $article['auteur'] != $_SESSION['user_id']) {
            header("Location: ?controller=editor&action=index");
            exit;
        }

        require __DIR__ . '/../views/editorEdit.php';
    }

    // Traite la modification
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $categoryId = intval($_POST['category_id']);

            $article = $this->articleModel->getArticleById($id);

            if ($article && $article['auteur'] == $_SESSION['user_id']) {
                $this->articleModel->update($id, $title, $content, $categoryId);
            }

            header("Location: ?controller=editor&action=index");
            exit;
        }
    }

    // Supprime l'article
    public function delete($id) {
        $article = $this->articleModel->getArticleById($id);

        if ($article && $article['auteur'] == $_SESSION['user_id']) {
            $this->articleModel->delete($id);
        }

        header("Location: ?controller=editor&action=index");
        exit;
    }
}
?>
