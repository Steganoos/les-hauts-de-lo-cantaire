<?php
$title = "Les Hauts de Lo Cantaire - Login -";
$css = BASE_URL . "public/css/login.css";

ob_start();
?>

<main>
  <div class="container">
    <h1>Login</h1>
    <?php if (!empty($errorMessage)) : ?>
        <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>
    <form action="index.php?page=authController" method="post">
      <div>
        <label for="email">Adresse email :</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div>
        <button type="submit">Se connecter</button>
      </div>
    </form>
  </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once __DIR__ . '/../layout/layout.php'; ?>
