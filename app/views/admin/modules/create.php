<?php require __DIR__ . '/../../layouts/header.php'; ?>

<h2>Add Module</h2>

<?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?action=admin_module_store">
    <label for="module_name">Module Name *</label>
<input type="text" id="module_name" name="module_name"
       value="<?= htmlspecialchars($_POST['module_name'] ?? '') ?>" required>

    <label for="leader_id">Module Leader</label>
<select id="leader_id" name="leader_id">
    <option value="">Select Staff</option>
    <?php foreach ($staff as $member): ?>
        <option value="<?= $member['StaffID'] ?>"
            <?= (($_POST['leader_id'] ?? '') == $member['StaffID']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($member['Name']) ?>
        </option>
    <?php endforeach; ?>
</select>

    <label for="description">Description</label>
<textarea id="description" name="description" rows="5"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

    <label for="image">Image</label>
<input type="text" id="image" name="image"
       value="<?= htmlspecialchars($_POST['image'] ?? '') ?>">

    <label for="programme_id">Attach to Programme</label>

    <select id="programme_id" name="programme_id">
    <option value="">Select Programme</option>
    <?php foreach ($programmes as $programme): ?>
        <option value="<?= $programme['ProgrammeID'] ?>"
            <?= (($_POST['programme_id'] ?? '') == $programme['ProgrammeID']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($programme['ProgrammeName']) ?>
        </option>
    <?php endforeach; ?>
</select>

    <label for="year">Year of Study</label>
<select id="year" name="year">
    <option value="">Select Year</option>
    <option value="1" <?= (($_POST['year'] ?? '') == '1') ? 'selected' : '' ?>>Year 1</option>
    <option value="2" <?= (($_POST['year'] ?? '') == '2') ? 'selected' : '' ?>>Year 2</option>
    <option value="3" <?= (($_POST['year'] ?? '') == '3') ? 'selected' : '' ?>>Year 3</option>
    <option value="4" <?= (($_POST['year'] ?? '') == '4') ? 'selected' : '' ?>>Year 4</option>
</select>
    <button type="submit">Save Module</button>
</form>

<p><a href="index.php?action=admin_modules">Back</a></p>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>