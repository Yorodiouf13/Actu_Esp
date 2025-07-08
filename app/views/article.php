<?php include 'app\views\includes\header.php'; ?>
<?php if ($article): ?>
<article class="full-article">
  <h1><?= htmlspecialchars($article['titre']) ?></h1>
  <p class="card-meta">
    <strong><?= htmlspecialchars($article['categorieLibelle']) ?></strong> —
    <?= date('d/m/Y', strtotime($article['dateCreation'])) ?>
  </p>
  <div class="article-body">
    <?= nl2br(htmlspecialchars($article['contenu'])) ?>
  </div>
</article>
<?php else: ?>
  <p>Article non trouvé.</p>
<?php endif; ?>
<?php include 'app\views\includes\footer.php'; ?>