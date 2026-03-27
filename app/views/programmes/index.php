<?php require __DIR__ . '/../layouts/header.php'; ?>

<?php
$level = $_GET['level'] ?? null;
$keyword = $_GET['keyword'] ?? '';

$pageTitle = 'All Programmes';
$heroTitle = 'OUR PROGRAMMES:';

if ($level === 'BSc') {
    $pageTitle = 'BSc Programmes';
    $heroTitle = 'BSC PROGRAMMES';
} elseif ($level === 'MSc') {
    $pageTitle = 'MSc Programmes';
    $heroTitle = 'MSC PROGRAMMES';
}
?>

<style>
    .programmes-shell {
        width: 100%;
    }

    .programmes-page-card {
        background: #eef0f3;
        border-radius: 28px;
        padding: 28px 28px 36px;
    }

    .programme-hero-banner {
        position: relative;
        width: 100%;
        height: 165px;
        border-radius: 0;
        overflow: hidden;
        background: url('images/hero2.jpg') center center / cover no-repeat;
        margin-bottom: 26px;
    }

    .programme-hero-banner::after {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.10);
    }

    .programme-top-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 26px;
        flex-wrap: wrap;
    }

    .programme-page-title {
        font-size: 30px;
        font-weight: 900;
        letter-spacing: 1px;
        text-transform: uppercase;
        line-height: 1.1;
        color: #000000;
        margin: 0;
    }

    .programme-search-row {
        display: flex;
        justify-content: flex-end;
        margin-left: auto;
    }

    .programme-search-form {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .programme-search-form input[type="text"] {
        width: 300px;
        max-width: 100%;
        height: 46px;
        padding: 0 14px;
        border: 1px solid #d8dbe1;
        border-radius: 6px;
        background: #ffffff;
        font-size: 14px;
        color: #111827;
        outline: none;
    }

    .programme-search-form input[type="text"]:focus {
        border-color: #1f497d;
    }

    .programme-search-form button {
        height: 46px;
        padding: 0 20px;
        border: none;
        border-radius: 6px;
        background: #204a7b;
        color: #ffffff;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .programme-search-form button:hover {
        background: #183a61;
    }

    .programme-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        align-items: stretch;
    }

    .programme-card {
        background: #f7f7f8;
        border: 1px solid #ddcddb;
        padding: 12px;
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }

    .programme-card-level {
        font-size: 13px;
        color: #333333;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .programme-card-image {
        width: 100%;
        height: 170px;
        background: #dde3ea;
        overflow: hidden;
        margin-bottom: 14px;
    }

    .programme-card-image img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .programme-card-title {
        font-size: 16px;
        line-height: 1.15;
        font-weight: 800;
        color: #111111;
        margin: 0 0 12px;
        min-height: 74px;
    }

    .programme-card-text {
        font-size: 12px;
        line-height: 1.65;
        color: #5b6470;
        margin: 0 0 26px;
        flex-grow: 1;
    }

    .programme-card-link {
        margin-top: auto;
        text-decoration: none;
        color: #1c2430;
        font-size: 12px;
        line-height: 1.45;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-weight: 500;
    }

    .programme-card-link:hover {
        text-decoration: none;
    }

    .programme-card-link-text {
        display: inline-block;
        max-width: calc(100% - 34px);
    }

    .programme-card-link-circle {
        width: 18px;
        height: 18px;
        border: 1.5px solid #4b5563;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        line-height: 1;
        flex-shrink: 0;
    }

    .no-programmes {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 24px;
        color: #374151;
        font-size: 16px;
    }

    @media (max-width: 1150px) {
        .programme-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 860px) {
        .programmes-page-card {
            padding: 20px;
        }

        .programme-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .programme-top-row {
            align-items: stretch;
        }

        .programme-page-title {
            font-size: 22px;
        }

        .programme-search-row {
            width: 100%;
            justify-content: flex-start;
            margin-left: 0;
        }
    }

    @media (max-width: 560px) {
        .programme-grid {
            grid-template-columns: 1fr;
        }

        .programme-search-form {
            flex-direction: column;
            align-items: stretch;
            width: 100%;
        }

        .programme-search-form input[type="text"],
        .programme-search-form button {
            width: 100%;
        }

        .programme-card-title {
            min-height: auto;
        }

        .programme-top-row {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>

<div class="programmes-shell">
    <div class="programmes-page-card">

        <section class="programme-hero-banner"></section>

        <div class="programme-top-row">
            <h1 class="programme-page-title"><?php echo htmlspecialchars($heroTitle); ?></h1>

            <div class="programme-search-row">
                <form method="GET" class="programme-search-form">
                    <input type="hidden" name="action" value="programmes">

                    <?php if (!empty($level)): ?>
                        <input type="hidden" name="level" value="<?php echo htmlspecialchars($level); ?>">
                    <?php endif; ?>

                    <input
                        type="text"
                        name="keyword"
                        placeholder="Search programmes..."
                        value="<?php echo htmlspecialchars($keyword); ?>"
                    >

                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <?php if (!empty($programmes)): ?>
            <div class="programme-grid">
                <?php foreach ($programmes as $programme): ?>
                    <div class="programme-card">
                        <div class="programme-card-level">
                            <?php
                            $levelName = trim($programme['LevelName'] ?? '');
                            if ($levelName === 'BSc') {
                                echo 'Undergraduate';
                            } elseif ($levelName === 'MSc') {
                                echo 'Postgraduate';
                            } else {
                                echo htmlspecialchars($levelName ?: 'Programme');
                            }
                            ?>
                        </div>

                        <div class="programme-card-image">
                            <?php if (!empty($programme['Image'])): ?>
                                <img
                                    src="uploads/<?php echo htmlspecialchars($programme['Image']); ?>"
                                    alt="<?php echo htmlspecialchars($programme['ProgrammeName']); ?>"
                                >
                            <?php else: ?>
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#6b7280;font-weight:700;">
                                    No Image
                                </div>
                            <?php endif; ?>
                        </div>

                        <h3 class="programme-card-title">
                            <?php echo htmlspecialchars($programme['ProgrammeName']); ?>
                        </h3>

                        <p class="programme-card-text">
                            <?php
                            $description = trim($programme['Description'] ?? '');
                            echo !empty($description)
                                ? htmlspecialchars(mb_strimwidth($description, 0, 110, '...'))
                                : 'Click below to view full programme details and modules.';
                            ?>
                        </p>

                        <a class="programme-card-link" href="index.php?action=show&id=<?php echo (int)$programme['ProgrammeID']; ?>">
                            <span class="programme-card-link-text">Read more about the education</span>
                            <span class="programme-card-link-circle">→</span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-programmes">
                No programmes found.
            </div>
        <?php endif; ?>

    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>