<?php require __DIR__ . '/../../layouts/header.php'; ?>

<h2>Edit Module</h2>

<form method="POST" action="index.php?action=admin_module_update">
    <input type="hidden" name="module_id" value="<?= $module['ModuleID'] ?>">

    <label for="module_name">Module Name *</label>
    <input type="text" id="module_name" name="module_name" value="<?= htmlspecialchars($module['ModuleName']) ?>" required>

    <label for="leader_id">Module Leader</label>
    <select id="leader_id" name="leader_id">
        <option value="">Select Staff</option>
        <?php foreach ($staff as $member): ?>
            <option value="<?= $member['StaffID'] ?>" <?= ($module['ModuleLeaderID'] == $member['StaffID']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($member['Name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="description">Description</label>
    <textarea id="description" name="description" rows="5"><?= htmlspecialchars($module['Description'] ?? '') ?></textarea>

    <label for="image">Image</label>
    <input type="text" id="image" name="image" value="<?= htmlspecialchars($module['Image'] ?? '') ?>">

    <button type="submit">Update Module</button>
</form>

<p><a href="index.php?action=admin_modules">Back</a></p>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>