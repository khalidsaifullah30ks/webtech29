<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="withdraw-wrapper">
    <div class="withdraw-card">

        <h2 class="withdraw-title">Register Interest</h2>

        <p class="withdraw-programme">
            <strong>Programme:</strong> <?= htmlspecialchars($programme['ProgrammeName']) ?>
        </p>

        <?php if (!empty($error)): ?>
            <p class="withdraw-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?action=store_interest" class="withdraw-form">
            <input type="hidden" name="programme_id" value="<?= $programme['ProgrammeID'] ?>">

            <div class="withdraw-field">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="withdraw-field">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="withdraw-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit" class="withdraw-btn">Submit</button>
        </form>

    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>