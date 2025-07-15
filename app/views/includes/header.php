<?php
require_once 'db.php';
require_once 'app\models\categorie.php';
$categoryModel = new Categorie();
$navCats = $categoryModel->getAllCategories();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>ESP ActU</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public\styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<header class="site-header">
  <div class="header-top container">
    <div class="logo">
      <a href="/esp_news_mvc/index.php">
        <img src="public\img\logo.png" alt="ESP Logo"> 
      </a>
      <p>ActUPolytech</p>
    </div>
    <div class="burger" onclick="toggleMenu()">☰</div>
    <?php if (!empty($_SESSION['user_id'])): ?>
  <form action="?controller=auth&action=logout" method="post" >
    <button type="submit" class="logout-btn">Se déconnecter</button>
  </form>
<?php endif; ?>
  </div>
  <nav class="site-nav container" id="siteNav">
    <ul class="nav-list">
      <li><a href="/esp_news_mvc/index.php">Accueil</a></li>
      <?php if ($_SESSION['role'] === 'editor'): ?>
        <li>
            <a class="nav-link" href="?controller=editor&action=index">Mon espace éditeur</a>
        </li>
      <?php endif; ?>  
      <?php foreach ($navCats as $cat): ?>
        <li>
          <a href="/esp_news_mvc/index.php?controller=categorie&action=index&id=<?= $cat['id'] ?>">
            <?= htmlspecialchars($cat['libelle']) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
</header>
<main class="site-main container">