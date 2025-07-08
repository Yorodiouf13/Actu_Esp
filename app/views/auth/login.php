
<link rel="stylesheet" href="public\auth.css">
<div class="auth-container">
  <h2>Connexion</h2>
  <?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form action="?controller=auth&action=authenticate" method="post">
    <div>
      <label for="login">Login :</label>
      <input type="text" name="login" id="login" required>
    </div>
    <div>
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Se connecter</button>
  </form>
  <p>Pas encore de compte ? <a href="?controller=auth&action=register">S'inscricre</a></p>
</div>


