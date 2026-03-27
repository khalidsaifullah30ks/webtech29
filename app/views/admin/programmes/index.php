<?php require __DIR__ . '/../../layouts/header.php'; ?>

<h2>Manage Programmes</h2>
<p class="page-intro">
    Create, review, edit, and manage all programmes from one place.
</p>

<div class="card-actions" style="margin-bottom: 20px;">
    <a class="button-link" href="index.php?action=admin_programme_create">Add New Programme</a>
</div>

<?php if (!empty($programmes)): ?>
    <?php foreach ($programmes as $programme): ?>
        <div class="card">
            <h3 class="card-title"><?= htmlspecialchars($programme['ProgrammeName']) ?></h3>

            <p class="card-meta">
                <strong>Level:</strong> <?= htmlspecialchars($programme['LevelName'] ?? '') ?>
            </p>

            <p class="card-text">
                <?= htmlspecialchars($programme['Description'] ?? '') ?>
            </p>

            <div class="card-actions">
                <a class="button-secondary" href="index.php?action=admin_programme_modules&id=<?= $programme['ProgrammeID'] ?>">Modules</a>
                <a class="button-link" href="index.php?action=admin_programme_edit&id=<?= $programme['ProgrammeID'] ?>">Edit</a>
            </div>

            <form method="POST" action="index.php?action=admin_programme_delete" onsubmit="return confirm('Delete this programme?');" style="margin-top: 14px;">
                <input type="hidden" name="id" value="<?= $programme['ProgrammeID'] ?>">
                <button type="submit">Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="card">
        <p>No programmes found.</p>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>