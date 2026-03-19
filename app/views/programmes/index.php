<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>All Programmes</h2>

<form method="GET" action="index.php">
    <input type="hidden" name="action" value="programmes">

    <label for="keyword">Search</label>
    <input type="text" id="keyword" name="keyword" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">

    <label for="level">Level</label>
    <select id="level" name="level">
        <option value="">All</option>
        <option value="Undergraduate" <?= (($_GET['level'] ?? '') === 'Undergraduate') ? 'selected' : '' ?>>Undergraduate</option>
        <option value="Postgraduate" <?= (($_GET['level'] ?? '') === 'Postgraduate') ? 'selected' : '' ?>>Postgraduate</option>
    </select>

    <button type="submit">Search</button>
</form>

<?php if (!empty($programmes)): ?>
    <?php foreach ($programmes as $programme): ?>
        <div class="card">
            <h3><?= htmlspecialchars($programme['ProgrammeName']) ?></h3>
            <p><strong>Level:</strong> <?= htmlspecialchars($programme['LevelName'] ?? '') ?></p>
            <p><?= htmlspecialchars($programme['Description'] ?? '') ?></p>
            <a href="index.php?action=programme_show&id=<?= $programme['ProgrammeID'] ?>">View Details</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No programmes found.</p>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>