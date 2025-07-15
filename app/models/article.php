<?php
require_once __DIR__ . '/../views/includes/db.php';

class Article {
    private $pdo; 

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo; 
    }

    public function getAllArticles() {
        $stmt = $this->pdo->query("SELECT a.*, c.libelle FROM Article a JOIN Categorie c ON a.categorie = c.id ORDER BY a.dateCreation DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleById($id) {
        $stmt = $this->pdo->prepare("SELECT a.*, c.libelle as categorieLibelle FROM Article a JOIN Categorie c ON a.categorie = c.id WHERE a.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getArticlesByCategory($categoryId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Article WHERE categorie = ? ORDER BY dateCreation DESC");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($categoryId = null) {
    if ($categoryId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM Article WHERE categorie = ?");
        $stmt->execute([$categoryId]);
    } else {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM Article");
    }
    return $stmt->fetchColumn();
    }

    public function getPaginatedArticles($page, $perPage, $categoryId = null) {
        $offset = ($page - 1) * $perPage;
        if ($categoryId) {
            $stmt = $this->pdo->prepare("SELECT a.*, c.libelle FROM Article a JOIN Categorie c ON a.categorie = c.id WHERE a.categorie = ? ORDER BY a.dateCreation DESC LIMIT ?, ?");
            $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
            $stmt->bindValue(2, $offset, PDO::PARAM_INT);
            $stmt->bindValue(3, $perPage, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("SELECT a.*, c.libelle FROM Article a JOIN Categorie c ON a.categorie = c.id ORDER BY a.dateCreation DESC LIMIT ?, ?");
            $stmt->bindValue(1, $offset, PDO::PARAM_INT);
            $stmt->bindValue(2, $perPage, PDO::PARAM_INT);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticlesByAuthor($authorId) {
        $stmt = $this->pdo->prepare("SELECT a.*, c.libelle FROM Article a JOIN Categorie c ON a.categorie = c.id WHERE a.auteur = ? ORDER BY a.dateCreation DESC");
        $stmt->execute([$authorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $content, $authorId, $categoryId) {
        $stmt = $this->pdo->prepare("INSERT INTO Article (titre, contenu, auteur, categorie, dateCreation) VALUES (?, ?, ?, ?, NOW())");
        return $stmt->execute([$title, $content, $authorId, $categoryId]);
    }

    public function update($id, $title, $content, $categoryId) {
        $stmt = $this->pdo->prepare("UPDATE Article SET titre = ?, contenu = ?, categorie = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $categoryId, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Article WHERE id = ?");
        return $stmt->execute([$id]);
    }

}
?>
