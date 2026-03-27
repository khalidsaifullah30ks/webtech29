<?php require __DIR__ . '/../layouts/header.php'; ?>

<style>
    main {
        background: transparent !important;
        box-shadow: none !important;
        padding: 0 !important;
        border-radius: 0 !important;
        max-width: 1380px;
    }

    .admin-dashboard-wrap {
        width: 100%;
        margin: 34px auto 50px;
    }

    .admin-dashboard-card {
        background: linear-gradient(135deg, #f8fafc 0%, #eef2f7 100%);
        border-radius: 34px;
        padding: 36px;
        border: 1px solid #e5eaf0;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
    }

    .admin-dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .admin-dashboard-title h2 {
        margin: 0 0 10px;
        font-size: 40px;
        line-height: 1.05;
        color: #0f172a;
        font-weight: 800;
        letter-spacing: -0.7px;
    }

    .admin-dashboard-title p {
        margin: 0;
        font-size: 15px;
        color: #64748b;
        max-width: 760px;
    }

    .admin-dashboard-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 18px;
        border-radius: 999px;
        background: #0f172a;
        color: #ffffff;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.18);
    }

    .admin-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .admin-stat-box {
        background: #ffffff;
        border: 1px solid #ebf0f5;
        border-radius: 24px;
        padding: 24px 22px;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .admin-stat-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.08);
    }

    .admin-stat-box strong {
        display: block;
        margin: 0 0 10px;
        font-size: 40px;
        line-height: 1;
        font-weight: 800;
        color: #0f172a;
    }

    .admin-stat-label {
        font-size: 14px;
        color: #64748b;
        font-weight: 700;
    }

    .admin-section-card {
        background: #ffffff;
        border: 1px solid #ebf0f5;
        border-radius: 26px;
        padding: 24px;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.05);
        margin-bottom: 24px;
    }

    .admin-section-card h3 {
        margin: 0 0 18px;
        font-size: 26px;
        line-height: 1.1;
        color: #0f172a;
        font-weight: 800;
        letter-spacing: -0.4px;
    }

    .admin-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    .admin-actions a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 175px;
        padding: 14px 20px;
        border-radius: 14px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
    }

    .admin-actions .admin-primary-btn {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #ffffff;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.18);
    }

    .admin-actions .admin-secondary-btn {
        background: #ffffff;
        color: #0f172a;
        border: 1px solid #d9e2ec;
    }

    .admin-actions a:hover {
        transform: translateY(-2px);
        opacity: 0.97;
    }

    .admin-table-shell {
        overflow-x: auto;
        border: 1px solid #e8edf3;
        border-radius: 18px;
    }

    .admin-dashboard-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
        background: #ffffff;
    }

    .admin-dashboard-table thead th {
        background: #f8fafc;
        color: #0f172a;
        font-size: 14px;
        font-weight: 800;
        text-align: left;
        padding: 16px 18px;
        border: none;
        border-bottom: 1px solid #e8edf3;
        white-space: nowrap;
    }

    .admin-dashboard-table tbody td {
        padding: 16px 18px;
        font-size: 14px;
        color: #334155;
        border: none;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
    }

    .admin-dashboard-table tbody tr:hover {
        background: #fafcff;
    }

    .admin-status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 96px;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.2px;
    }

    .admin-status-active {
        background: #dcfce7;
        color: #166534;
    }

    .admin-status-withdrawn {
        background: #fee2e2;
        color: #991b1b;
    }

    .admin-empty-box {
        padding: 18px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px dashed #d8e1ea;
        color: #64748b;
        font-size: 15px;
    }

    @media (max-width: 1100px) {
        .admin-stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .admin-dashboard-card {
            padding: 22px;
            border-radius: 24px;
        }

        .admin-dashboard-title h2 {
            font-size: 30px;
        }

        .admin-stats-grid {
            grid-template-columns: 1fr;
        }

        .admin-section-card h3 {
            font-size: 22px;
        }

        .admin-actions a {
            width: 100%;
            min-width: unset;
        }
    }
</style>

<div class="admin-dashboard-wrap">
    <div class="admin-dashboard-card">

        <div class="admin-dashboard-header">
            <div class="admin-dashboard-title">
                <h2>Admin Dashboard</h2>
                <p>Manage programmes, modules, and student interest records from this control panel.</p>
            </div>

            <div class="admin-dashboard-badge">Control Panel</div>
        </div>

        <div class="admin-stats-grid">
            <div class="admin-stat-box">
                <strong><?= $programmeCount ?></strong>
                <div class="admin-stat-label">Programmes</div>
            </div>

            <div class="admin-stat-box">
                <strong><?= $moduleCount ?></strong>
                <div class="admin-stat-label">Modules</div>
            </div>

            <div class="admin-stat-box">
                <strong><?= $studentCount ?></strong>
                <div class="admin-stat-label">Total Interests</div>
            </div>

            <div class="admin-stat-box">
                <strong><?= $activeStudentCount ?></strong>
                <div class="admin-stat-label">Active Interests</div>
            </div>
        </div>

        <div class="admin-section-card">
            <h3>Quick Actions</h3>
            <div class="admin-actions">
                <a class="admin-primary-btn" href="index.php?action=admin_programme_create">Add Programme</a>
                <a class="admin-primary-btn" href="index.php?action=admin_module_create">Add Module</a>
                <a class="admin-secondary-btn" href="index.php?action=admin_programmes">Manage Programmes</a>
                <a class="admin-secondary-btn" href="index.php?action=admin_modules">Manage Modules</a>
            </div>
        </div>

        <div class="admin-section-card">
            <h3>Recent Student Interests</h3>

            <?php if (!empty($students)): ?>
                <div class="admin-table-shell">
                    <table class="admin-dashboard-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Programme</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?= htmlspecialchars($student['StudentName'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($student['Email'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($student['ProgrammeName'] ?? '') ?></td>
                                    <td>
                                        <?php if (!empty($student['IsActive'])): ?>
                                            <span class="admin-status-badge admin-status-active">Active</span>
                                        <?php else: ?>
                                            <span class="admin-status-badge admin-status-withdrawn">Withdrawn</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="admin-empty-box">No student interest records found.</div>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>