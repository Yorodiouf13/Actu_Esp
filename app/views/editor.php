<?php require_once __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">
    <h2>Tableau de bord Éditeur</h2>
    <a href="?controller=editor&action=create" class="btn btn-success mb-3">Créer un nouvel article</a>

    <?php if (!empty($articles)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= htmlspecialchars($article['titre']) ?></td>
                        <td><?= htmlspecialchars($article['libelle']) ?></td>
                        <td><?= htmlspecialchars($article['dateCreation']) ?></td>
                        <td>
                            <a href="?controller=editor&action=edit&id=<?= $article['id'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="?controller=editor&action=delete&id=<?= $article['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">
            Vous n'avez pas encore publié d'articles.
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
