<?php require __DIR__ . '/../layouts/header.php'; ?>

<?php
$programmeName = $programme['ProgrammeName'] ?? 'Programme Details';
$programmeDescription = $programme['Description'] ?? '';
$programmeImage = trim($programme['Image'] ?? '');
$programmeLevel = $programme['LevelName'] ?? 'N/A';

$grouped = [];
foreach ($modules as $m) {
    $year = $m['Year'] ?? 'Other';
    $grouped[$year][] = $m;
}

ksort($grouped);

$totalModules = count($modules);
$totalYears = count($grouped);

/* Fix programme image path */
$programmeImagePath = '';
if (!empty($programmeImage)) {
    if (
        strpos($programmeImage, 'uploads/') === 0 ||
        strpos($programmeImage, 'images/') === 0 ||
        strpos($programmeImage, 'http://') === 0 ||
        strpos($programmeImage, 'https://') === 0
    ) {
        $programmeImagePath = $programmeImage;
    } else {
        $programmeImagePath = 'uploads/' . $programmeImage;
    }
}
?>

<style>
    .programme-details-page {
        width: 92%;
        max-width: 1200px;
        margin: 40px auto;
    }

    .programme-hero {
        display: grid;
        grid-template-columns: 1.3fr 0.9fr;
        gap: 28px;
        align-items: stretch;
        margin-bottom: 30px;
    }

    .programme-main-card,
    .programme-side-card,
    .programme-year-card {
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        border: 1px solid #e5e7eb;
    }

    .programme-main-card {
        padding: 32px;
    }

    .programme-badge-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
    }

    .programme-badge {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        background: #eef2ff;
        color: #1d4ed8;
    }

    .programme-title {
        margin: 0 0 14px;
        font-size: 38px;
        line-height: 1.15;
        color: #0f172a;
    }

    .programme-desc {
        margin: 0;
        font-size: 16px;
        line-height: 1.8;
        color: #475569;
    }

    .programme-side-card {
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .programme-image-wrap {
        width: 100%;
        height: 260px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }

    .programme-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .programme-summary {
        padding: 24px;
    }

    .programme-summary h3 {
        margin: 0 0 16px;
        font-size: 22px;
        color: #111827;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .summary-item {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 14px 16px;
    }

    .summary-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #64748b;
        margin-bottom: 6px;
    }

    .summary-value {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
    }

    .section-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin: 0 0 18px;
    }

    .section-heading h2 {
        margin: 0;
        font-size: 30px;
        color: #0f172a;
    }

    .module-count-chip {
        padding: 8px 14px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .programme-years {
        display: grid;
        gap: 24px;
    }

    .programme-year-card {
        padding: 24px;
    }

    .year-title {
        margin: 0 0 18px;
        font-size: 24px;
        color: #111827;
        border-left: 5px solid #2563eb;
        padding-left: 12px;
    }

    .module-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 18px;
    }

    .module-card {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .module-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    }

    .module-image {
        width: 100%;
        height: 160px;
        background: #e5e7eb;
    }

    .module-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .module-body {
        padding: 18px;
    }

    .module-title {
        margin: 0 0 10px;
        font-size: 20px;
        line-height: 1.3;
        color: #0f172a;
    }

    .module-text {
        margin: 0;
        font-size: 14px;
        line-height: 1.75;
        color: #475569;
    }

    .empty-modules {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 28px;
        text-align: center;
        color: #64748b;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
    }

     .action-links-wrap {
        margin-top: 30px;
        display: flex;
        gap: 14px;
        align-items: center;
        flex-wrap: wrap;
    }

    .register-link,
    .back-link {
        display: inline-block;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 12px;
        font-weight: 700;
        transition: background 0.2s ease, transform 0.2s ease;
    }

.register-link {
    background: #111827;
    color: #ffffff;
}

.register-link:hover {
    background: #374151;
}
    .back-link {
        background: #0f172a;
        color: #ffffff;
    }

    .back-link:hover {
        background: #1e293b;
        transform: translateY(-1px);
    }

    @media (max-width: 900px) {
        .programme-hero {
            grid-template-columns: 1fr;
        }

        .programme-title {
            font-size: 30px;
        }

        .section-heading {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 600px) {
        .programme-details-page {
            width: 94%;
            margin: 24px auto;
        }

        .programme-main-card,
        .programme-year-card {
            padding: 20px;
        }

        .programme-title {
            font-size: 26px;
        }
    }
</style>

<div class="programme-details-page">

    <section class="programme-hero">
        <div class="programme-main-card">
            <div class="programme-badge-row">
                <span class="programme-badge"><?= htmlspecialchars($programmeLevel) ?></span>
                <span class="programme-badge"><?= $totalModules ?> Module<?= $totalModules !== 1 ? 's' : '' ?></span>
                <span class="programme-badge"><?= $totalYears ?> Year Group<?= $totalYears !== 1 ? 's' : '' ?></span>
            </div>

            <h1 class="programme-title"><?= htmlspecialchars($programmeName) ?></h1>

            <p class="programme-desc">
                <?= !empty($programmeDescription) ? nl2br(htmlspecialchars($programmeDescription)) : 'No programme description available.' ?>
            </p>
        </div>

        <aside class="programme-side-card">
            <?php if (!empty($programmeImagePath)): ?>
                <div class="programme-image-wrap">
                    <img src="<?= htmlspecialchars($programmeImagePath) ?>" alt="<?= htmlspecialchars($programmeName) ?>">
                </div>
            <?php else: ?>
                <div class="programme-image-wrap" style="display:flex;align-items:center;justify-content:center;color:#64748b;font-weight:700;">
                    No Programme Image
                </div>
            <?php endif; ?>

            <div class="programme-summary">
                <h3>Programme Summary</h3>

                <div class="summary-grid">
                    <div class="summary-item">
                        <span class="summary-label">Level</span>
                        <span class="summary-value"><?= htmlspecialchars($programmeLevel) ?></span>
                    </div>

                    <div class="summary-item">
                        <span class="summary-label">Total Modules</span>
                        <span class="summary-value"><?= $totalModules ?></span>
                    </div>

                    <div class="summary-item">
                        <span class="summary-label">Years Covered</span>
                        <span class="summary-value"><?= $totalYears ?></span>
                    </div>
                </div>
            </div>
        </aside>
    </section>

    <section>
        <div class="section-heading">
            <h2>Modules</h2>
            <span class="module-count-chip"><?= $totalModules ?> module<?= $totalModules !== 1 ? 's' : '' ?> available</span>
        </div>

        <?php if (!empty($modules)): ?>
            <div class="programme-years">
                <?php foreach ($grouped as $year => $mods): ?>
                    <div class="programme-year-card">
                        <h3 class="year-title">Year <?= htmlspecialchars($year) ?></h3>

                        <div class="module-grid">
                            <?php foreach ($mods as $mod): ?>
                                <article class="module-card">
                                    <?php if (!empty($mod['Image'])): ?>
                                        <div class="module-image">
                                            <img src="images/<?= htmlspecialchars($mod['Image']) ?>" alt="<?= htmlspecialchars($mod['ModuleName'] ?? 'Module') ?>">
                                        </div>
                                    <?php endif; ?>

                                    <div class="module-body">
                                        <h4 class="module-title"><?= htmlspecialchars($mod['ModuleName'] ?? 'Untitled Module') ?></h4>
                                        <p class="module-text">
                                            <?= !empty($mod['Description']) ? nl2br(htmlspecialchars($mod['Description'])) : 'No description available.' ?>
                                        </p>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-modules">
                <h3 style="margin-top:0; color:#0f172a;">No modules found for this programme</h3>
                <p style="margin-bottom:0;">This programme is available, but its module list has not been added yet.</p>
            </div>
        <?php endif; ?>
    </section>

<div class="action-links-wrap">
    <a class="register-link" href="index.php?action=register_interest&id=<?= (int) $programme['ProgrammeID'] ?>">
        Register Interest
    </a>

    <a class="back-link" href="index.php?action=programmes">
        ← Back to Programmes
    </a>
</div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>