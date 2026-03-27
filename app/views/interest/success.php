<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="withdraw-wrapper">
    <div class="withdraw-card success-card">

        <div class="success-icon-wrap">
            <div class="success-icon">✓</div>
        </div>

        <h2 class="withdraw-title">Success</h2>

        <p class="success-message-box">
            <?= htmlspecialchars($success) ?>
        </p>

        <div class="success-actions">
            <a href="index.php?action=programmes" class="withdraw-btn success-link-btn">Back to Programmes</a>
        </div>

    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>