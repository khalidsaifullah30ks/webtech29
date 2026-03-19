<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2><?= htmlspecialchars($programme['ProgrammeName']) ?></h2>
<p><strong>Level:</strong> <?= htmlspecialchars($programme['LevelName'] ?? '') ?></p>
<p><?= htmlspecialchars($programme['Description'] ?? '') ?></p>

<?php if (!empty($programme['ProgrammeLeaderName'])): ?>
    <p>
        <strong>Programme Leader:</strong>
        <?= htmlspecialchars($programme['ProgrammeLeaderName']) ?>
    </p>
<?php endif; ?>

<h3>Modules</h3>

<?php if (!empty($modules)): ?>
    <?php foreach ($modules as $module): ?>
        <div class="card">
            <h4><?= htmlspecialchars($module['ModuleName']) ?></h4>
            <p><strong>Year:</strong> <?= htmlspecialchars($module['Year']) ?></p>
            <p><?= htmlspecialchars($module['Description'] ?? '') ?></p>
            <p><strong>Module Leader:</strong> <?= htmlspecialchars($module['ModuleLeaderName'] ?? '') ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No modules found.</p>
<?php endif; ?>

<p>
    <a href="index.php?action=register_interest&id=<?= $programme['ProgrammeID'] ?>">Register Interest</a>
</p>

<p><a href="index.php?action=programmes">Back to Programmes</a></p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>