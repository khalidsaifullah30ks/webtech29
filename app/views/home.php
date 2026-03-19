<?php require __DIR__ . '/layouts/header.php'; ?>

<h2>Welcome</h2>
<p>Explore our undergraduate and postgraduate programmes.</p>

<h3>Featured Programmes</h3>

<?php foreach ($programmes as $programme): ?>
    <div class="card">
        <h4><?= htmlspecialchars($programme['ProgrammeName']) ?></h4>
        <p><strong>Level:</strong> <?= htmlspecialchars($programme['LevelName'] ?? '') ?></p>
        <p><?= htmlspecialchars($programme['Description'] ?? '') ?></p>
        <a href="index.php?action=programme_show&id=<?= $programme['ProgrammeID'] ?>">View Details</a>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/layouts/footer.php'; ?>