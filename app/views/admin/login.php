<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>Admin Login</h2>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?action=admin_login_submit">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Login</button>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>