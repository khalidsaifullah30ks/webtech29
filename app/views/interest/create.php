<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>Register Interest</h2>

<p><strong>Programme:</strong> <?= htmlspecialchars($programme['ProgrammeName']) ?></p>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?action=store_interest">
    <input type="hidden" name="programme_id" value="<?= $programme['ProgrammeID'] ?>">

    <label for="first_name">First Name *</label>
    <input type="text" id="first_name" name="first_name" required>

    <label for="last_name">Last Name *</label>
    <input type="text" id="last_name" name="last_name" required>

    <label for="email">Email *</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Submit</button>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>