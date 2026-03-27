<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="admin-login-wrapper">
    <div class="admin-login-card">

        <h2 class="admin-title">Admin Login</h2>

        <?php if (!empty($error)): ?>
            <p class="admin-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?action=admin_login_submit" class="admin-form">

            <div class="admin-field">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="admin-field">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="admin-btn">Login</button>

        </form>

    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>