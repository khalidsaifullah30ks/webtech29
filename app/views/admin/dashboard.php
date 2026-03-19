<?php require __DIR__ . '/../layouts/header.php'; ?>

<h2>Admin Dashboard</h2>

<p>Welcome, <?= htmlspecialchars($_SESSION['admin_username'] ?? '') ?>.</p>

<p>
    <a href="index.php?action=admin_programmes">Manage Programmes</a> |
    <a href="index.php?action=admin_logout">Logout</a>
</p>

<h3>Interested Students</h3>

<?php if (!empty($students)): ?>
    <?php foreach ($students as $student): ?>
        <div class="card">
            <p><strong>Name:</strong> <?= htmlspecialchars($student['StudentName']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($student['Email']) ?></p>
            <p><strong>Programme:</strong> <?= htmlspecialchars($student['ProgrammeName']) ?></p>
            <p><strong>Status:</strong> <?= $student['IsActive'] ? 'Active' : 'Withdrawn' ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No student interest records found.</p>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>