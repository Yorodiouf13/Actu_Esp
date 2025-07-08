<?php include 'app\views\includes\header.php'; ?>
<section class="category-section">
  <h1 class="category-title">Articles dans « <?= htmlspecialchars($category['libelle']) ?> »</h1>

  <div class="articles-grid">
    <?php if (count($articles) === 0): ?>
      <p>Aucun article pour cette catégorie.</p>
    <?php else: ?>
      <?php foreach ($articles as $article): ?>
        <article class="card">
          <a href="/esp_news_mvc/index.php?controller=article&action=show&id=<?= $article['id'] ?>">
            <h2><?= htmlspecialchars($article['titre']) ?></h2>
          </a>
          <p class="card-meta">
            <?= date('d/m/Y', strtotime($article['dateCreation'])) ?>
          </p>
          <p><?= substr(strip_tags($article['contenu']), 0, 120) ?>…</p>
          <a href="/esp_news_mvc/index.php?controller=article&action=show&id=<?= $article['id'] ?>" class="btn-read">Lire la suite</a>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <?php if ($totalPages > 1): ?>
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?controller=categorie&action=index&id=<?= $category['id'] ?>&page=<?= $page-1 ?>">Précédent</a>
    <?php endif; ?>
    Page <?= $page ?> / <?= $totalPages ?>
    <?php if ($page < $totalPages): ?>
      <a href="?controller=categorie&action=index&id=<?= $category['id'] ?>&page=<?= $page+1 ?>">Suivant</a>
    <?php endif; ?>
  </div>
<?php endif; ?>

</section>
<?php include 'app\views\includes\footer.php'; ?>