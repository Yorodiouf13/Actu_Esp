
<link rel="stylesheet" href="public\auth.css">
<div class="auth-container">
  <h2>Créer un compte</h2>
  <?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form action="?controller=auth&action=store" method="post">
    <div>
      <label for="login">Login :</label>
      <input type="text" name="login" id="login" required>
    </div>
    <div>
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password" required>
    </div>
    <div>
      <label for="confirm">Confirmer le mot de passe :</label>
      <input type="password" name="confirm" id="confirm" required>
    </div>
    <button type="submit">S'inscrire</button>
  </form>
  <p>Déjà un compte ? <a href="?controller=auth&action=login">Se connecter</a></p>
</div>


