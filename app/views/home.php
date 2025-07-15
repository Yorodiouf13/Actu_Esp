<?php include 'app\views\includes\header.php'; ?>
<section class="hero">
  <?php if (!empty($articles)): 
    $first = $articles[0]; ?>
    <a href="/esp_news_mvc/index.php?controller=article&action=show&id=<?= $first['id'] ?>" class="hero-link">
      <div class="hero-content">
        <h1><?= htmlspecialchars($first['titre']) ?></h1>
        <p class="hero-meta">
          <?= htmlspecialchars($first['libelle']) ?> — 
          <?= date('d/m/Y', strtotime($first['dateCreation'])) ?>
        </p>
        <p><?= substr(strip_tags($first['contenu']), 0, 190) ?>…</p>
      </div>
    </a>
  <?php endif; ?>
</section>

<section class="articles-grid">
  <?php foreach (array_slice($articles, 1) as $article): ?>
    <article class="card">
      <a href="/esp_news_mvc/index.php?controller=article&action=show&id=<?= $article['id'] ?>">
        <h2><?= htmlspecialchars($article['titre']) ?></h2>
      </a>
      <p class="card-meta">
        <a href="/esp_news_mvc/index.php?controller=categorie&action=index&id=<?= $article['categorie'] ?>" class="categorie-link">
          <?= htmlspecialchars($article['libelle']) ?>
        </a>
        | <em>Publié le <?= date('d/m/Y', strtotime($article['dateCreation'])); ?></em>
      </p>
      <p><?= substr(strip_tags($article['contenu']), 0, 120) ?>…</p>
      <a href="/esp_news_mvc/index.php?controller=article&action=show&id=<?= $article['id'] ?>" class="btn-read">Lire la suite</a>
    </article>
  <?php endforeach; ?>
</section>
<?php if ($totalPages > 1): ?>
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?page=<?= $page-1 ?>">Précédent</a>
    <?php endif; ?>
    Page <?= $page ?> / <?= $totalPages ?>
    <?php if ($page < $totalPages): ?>
      <a href="?page=<?= $page+1 ?>">Suivant</a>
    <?php endif; ?>
  </div>
<?php endif; ?>

<script>
    document.querySelectorAll('.article-card h2 a').forEach(link => {
        link.addEventListener('mouseover', () => link.style.color = '#0056b3');
        link.addEventListener('mouseout', () => link.style.color = '#004085');
    });
</script>

<?php include 'app\views\includes\footer.php'; ?>