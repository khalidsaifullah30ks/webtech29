<?php require __DIR__ . '/../../layouts/header.php'; ?>

<h2>Manage Programmes</h2>

<p>
    <a href="index.php?action=admin_dashboard">Back to Dashboard</a> |
    <a href="index.php?action=admin_programme_create">Add Programme</a>
</p>

<?php if (!empty($programmes)): ?>
    <?php foreach ($programmes as $programme): ?>
        <div class="card">
            <h3><?= htmlspecialchars($programme['ProgrammeName']) ?></h3>
            <p><strong>Level:</strong> <?= htmlspecialchars($programme['LevelName'] ?? '') ?></p>
            <p><strong>Published:</strong> <?= $programme['IsPublished'] ? 'Yes' : 'No' ?></p>

            <p>
                <a href="index.php?action=admin_programme_edit&id=<?= $programme['ProgrammeID'] ?>">Edit</a> |
                <a href="index.php?action=admin_programme_toggle&id=<?= $programme['ProgrammeID'] ?>">
                    <?= $programme['IsPublished'] ? 'Unpublish' : 'Publish' ?>
                </a> |
                <a href="index.php?action=admin_programme_delete&id=<?= $programme['ProgrammeID'] ?>" onclick="return confirm('Delete this programme?')">Delete</a>
            </p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No programmes found.</p>
<?php endif; ?>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>