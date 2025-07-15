<?php require_once __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">
    <h2>Modifier l'article</h2>

    <form method="POST" action="?controller=editor&action=edit&id=<?= $article['id'] ?><?= $article['id'] ?>">
        <div class="form-group mb-3">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($article['titre']) ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="content">Contenu</label>
            <textarea class="form-control" id="content" name="content" rows="6" required><?= htmlspecialchars($article['contenu']) ?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Catégorie</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <?php
                require_once __DIR__ . '/../models/categorie.php';
                $catModel = new Categorie();
                $categories = $catModel->getAllCategories();
                foreach ($categories as $cat):
                ?>
                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $article['categorie']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['libelle']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="?controller=editor&action=index" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
