<?php require __DIR__ . '/../../layouts/header.php'; ?>

<h2>Add Programme</h2>

<?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?action=admin_programme_store">
    <label for="programme_name">Programme Name *</label>
    <input type="text" id="programme_name" name="programme_name" required>

    <label for="level_id">Level *</label>
    <select id="level_id" name="level_id" required>
        <option value="1">Undergraduate</option>
        <option value="2">Postgraduate</option>
    </select>

    <label for="programme_leader_id">Programme Leader ID</label>
    <input type="number" id="programme_leader_id" name="programme_leader_id">

    <label for="description">Description *</label>
    <textarea id="description" name="description" rows="5" required></textarea>

    <label for="image">Image</label>
    <input type="text" id="image" name="image">

    <label>
        <input type="checkbox" name="is_published" checked>
        Published
    </label>

    <button type="submit">Save Programme</button>
</form>

<p><a href="index.php?action=admin_programmes">Back</a></p>

<?php require __DIR__ . '/../../layouts/footer.php'; ?>