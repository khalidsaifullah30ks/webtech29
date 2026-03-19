<?php require __DIR__ . '/../../layouts/header.php'; ?>

<h2>Edit Programme</h2>

<form method="POST" action="index.php?action=admin_programme_update">
    <input type="hidden" name="programme_id" value="<?= $programme['ProgrammeID'] ?>">

    <label for="programme_name">Programme Name *</label>
    <input type="text" id="programme_name" name="programme_name" value="<?= htmlspecialchars($programme['ProgrammeName']) ?>" required>

    <label for="level_id">Level *</label>
    <select id="level_id" name="level_id" required>
        <option value="1" <?= $programme['LevelID'] == 1 ? 'selected' : '' ?>>Undergraduate</option>
        <option value="2" <?= $programme['LevelID'] == 2 ? 'selected' : '' ?>>Postgraduate</option>
    </select>

    <label for="programme_leader_id">Programme Leader ID</label>
    <input type="number" id="programme_leader_id" name="programme_leader_id" value="<?= htmlspecialchars($programme['ProgrammeLeaderID'] ?? '') ?>">

    <label for="description">Description *</label>
    <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($programme['Description']) ?></textarea>

    <label for="image">Image</label>
    <input type="text" id="image" name="image" value="<?= htmlspecialchars($programme['Image'] ?? '') ?>">

    <label>
        <input type="checkbox" name="is_published" <?= !empty($programme['IsPublished']) ? 'checked' : '' ?>>
        Published
    </label>

    <button type="submit">Update Programme</button>
</form>

<p><a href="index.php?action=admin_programmes">Back</a></p>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>