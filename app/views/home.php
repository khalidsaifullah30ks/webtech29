<?php require __DIR__ . '/layouts/header.php'; ?>

<style>
.hero-slider {
    position: relative;
    width: 100%;
    height: 560px;
    overflow: hidden;
}

.slides {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 0.8s ease-in-out;
}

.slide {
    min-width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}

    .slide.active {
        opacity: 1;
    }

    .slider-overlay {
        position: absolute;
        left: 50%;
        bottom: 48px;
        transform: translateX(-50%);
        width: calc(100% - 60px);
        max-width: 1100px;
        color: #ffffff;
        z-index: 2;
    }

    .slider-overlay h1 {
        margin: 0 0 10px;
        font-size: 42px;
        line-height: 1.1;
        color: #ffffff;
        text-shadow: 0 2px 14px rgba(0, 0, 0, 0.35);
    }

    .slider-overlay p {
        margin: 0;
        font-size: 18px;
        color: #f8fafc;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.35);
    }

    .home-programme-strip {
        background: #d8e6df;
        margin-top: 0;
        border-top: 1px solid #c7d7cf;
        border-bottom: 1px solid #c7d7cf;
    }

    .home-programme-strip-inner {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .home-programme-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 42px 56px;
        text-decoration: none;
        color: #000000;
        min-height: 145px;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .home-programme-link:hover {
        background: rgba(255, 255, 255, 0.18);
    }

    .home-programme-link + .home-programme-link {
        border-left: 2px solid rgba(0, 0, 0, 0.45);
    }

    .home-programme-title {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #251f1f;
    }

    .home-programme-arrow {
        width: 58px;
        height: 58px;
        border: 4px solid #000000;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 700;
        line-height: 1;
        flex-shrink: 0;
    }

    .welcome-card {
        margin-top: 32px;
    }

    @media (max-width: 900px) {
        .hero-slider {
            height: 420px;
        }

        .slider-overlay {
            width: calc(100% - 30px);
            bottom: 28px;
        }

        .slider-overlay h1 {
            font-size: 30px;
        }

        .slider-overlay p {
            font-size: 15px;
        }

        .home-programme-strip-inner {
            grid-template-columns: 1fr;
        }

        .home-programme-link {
            padding: 28px 24px;
            min-height: 110px;
        }

        .home-programme-link + .home-programme-link {
            border-left: none;
            border-top: 2px solid rgba(0, 0, 0, 0.45);
        }

        .home-programme-title {
            font-size: 25px;
        }

        .home-programme-arrow {
            width: 50px;
            height: 50px;
            font-size: 28px;
            border-width: 3px;
        }
    }
</style>
<section class="welcome-card">
    <h2>Welcome to Student Course Hub</h2>
    <p>Explore programmes, register your interest and manage your student journey.</p>
</section>

<section class="hero-slider">
    <div class="slides">
        <div class="slide active" style="background-image: url('images/hero1.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero2.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero3.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero4.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero5.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero6.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero7.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero8.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero9.jpg');"></div>
        <div class="slide" style="background-image: url('images/hero10.jpg');"></div>        

    </div>
</section>

<section class="home-programme-strip">
    <div class="home-programme-strip-inner">
        <a href="index.php?action=programmes&level=BSc" class="home-programme-link">
            <h2 class="home-programme-title">BSC PROGRAMMES</h2>
            <span class="home-programme-arrow">→</span>
        </a>

        <a href="index.php?action=programmes&level=MSc" class="home-programme-link">
            <h2 class="home-programme-title">MSC PROGRAMMES</h2>
            <span class="home-programme-arrow">→</span>
        </a>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');
    let current = 0;

    if (slides.length > 0) {
        setInterval(() => {
            slides[current].classList.remove('active');
            current = (current + 1) % slides.length;
            slides[current].classList.add('active');
        }, 3000);
    }
});
</script>

<?php require __DIR__ . '/layouts/footer.php'; ?>