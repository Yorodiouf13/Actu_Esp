<?php
require_once __DIR__ . '/../includes/db.php';

class Categorie {
    private $pdo;

   public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

   public function getCategoryById($id) {
        $stmt = $this->pdo->prepare("SELECT libelle FROM Categorie WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $stmt = $this->pdo->query("SELECT id, libelle FROM Categorie ORDER BY libelle");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategoriesWithArticles() {
    $stmt = $this->pdo->query("SELECT c.id, c.libelle, a.id as article_id, a.titre
        FROM Categorie c
        LEFT JOIN Article a ON a.categorie = c.id
        ORDER BY c.libelle, a.dateCreation DESC");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cats = [];
    foreach ($rows as $row) {
        $id = $row['id'];
        if (!isset($cats[$id])) {
            $cats[$id] = [
                'id' => $row['id'],
                'libelle' => $row['libelle'],
                'articles' => [],
            ];
        }
        if ($row['article_id']) {
            $cats[$id]['articles'][] = [
                'id' => $row['article_id'],
                'titre' => $row['titre'],
            ];
        }
    }
    return array_values($cats);
}

}
