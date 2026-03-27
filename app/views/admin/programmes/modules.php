<h2>Assign Modules to <?= htmlspecialchars($programme['ProgrammeName']) ?></h2>

<a href="index.php?action=admin_programmes">Back</a>

<form method="POST" action="index.php?action=admin_programme_module_store">

    <input type="hidden" name="programme_id" value="<?= $programme['ProgrammeID'] ?>">

    <label>Module</label>
    <select name="module_id">
        <?php foreach ($modules as $module): ?>
            <option value="<?= $module['ModuleID'] ?>">
                <?= htmlspecialchars($module['ModuleName']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Year</label>
    <select name="year">
        <option value="1">Year 1</option>
        <option value="2">Year 2</option>
        <option value="3">Year 3</option>
    </select>

    <button type="submit">Attach Module</button>

</form>

<h3>Assigned Modules</h3>

<?php if (!empty($assignedModules)): ?>
    <ul>
        <?php foreach ($assignedModules as $assigned): ?>
            <li>
                <?= htmlspecialchars($assigned['ModuleName']) ?> - Year <?= htmlspecialchars($assigned['Year']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No modules assigned yet.</p>
<?php endif; ?>