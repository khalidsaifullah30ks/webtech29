<?php require __DIR__ . '/../../layouts/header.php'; ?>

<h2>Manage Modules</h2>

<p>
    <a href="index.php?action=admin_dashboard">Back to Dashboard</a> |
    <a href="index.php?action=admin_module_create">Add Module</a>
</p>

<?php if (!empty($modules)): ?>
    <?php foreach ($modules as $module): ?>
        <div class="card">
            <h3><?= htmlspecialchars($module['ModuleName']) ?></h3>
            <p><strong>Leader:</strong> <?= htmlspecialchars($module['LeaderName'] ?? '') ?></p>
            <p><?= htmlspecialchars($module['Description'] ?? '') ?></p>

<p>
    <a href="index.php?action=admin_module_edit&id=<?= $module['ModuleID'] ?>">Edit</a>
</p>

<form method="POST" action="index.php?action=admin_module_delete" onsubmit="return confirm('Delete this module?');">
    <input type="hidden" name="id" value="<?= $module['ModuleID'] ?>">
    <button type="submit">Delete</button>
</form>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No modules found.</p>
<?php endif; ?>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>