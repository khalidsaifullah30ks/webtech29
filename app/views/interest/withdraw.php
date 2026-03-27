<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="withdraw-wrapper">
    <div class="withdraw-card">

        <h2 class="withdraw-title">Withdraw Interest</h2>

        <?php if (!empty($message)): ?>
            <p class="withdraw-success"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?action=withdraw_interest_submit" class="withdraw-form">

            <div class="withdraw-field">
                <label for="programme_id">Programme</label>
                <select id="programme_id" name="programme_id" required>
                    <option value="">Select Programme</option>
                    <?php foreach ($programmes as $programme): ?>
                        <option value="<?= $programme['ProgrammeID'] ?>">
                            <?= htmlspecialchars($programme['ProgrammeName']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="withdraw-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit" class="withdraw-btn">Withdraw</button>

        </form>

    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>