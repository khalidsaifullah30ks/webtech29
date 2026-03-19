<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>Withdraw Interest</h2>

<?php if (!empty($message)): ?>
    <p class="success"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?action=withdraw_interest_submit">
    <label for="programme_id">Programme</label>
    <select id="programme_id" name="programme_id" required>
        <option value="">Select Programme</option>
        <?php foreach ($programmes as $programme): ?>
            <option value="<?= $programme['ProgrammeID'] ?>">
                <?= htmlspecialchars($programme['ProgrammeName']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Withdraw</button>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>