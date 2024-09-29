<?php
global $sql;
$res = $sql->query('SELECT * FROM images');
$images = $res->fetchAll(PDO::FETCH_ASSOC);
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="./gui/css/gallery.css">
<main>
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="row pt-5">
            <div class="col-lg-12 text-center my-2">
                <h4>Events</h4>
            </div>
        </div>
        <div class="portfolio-menu mt-2 mb-4">
            <ul>
                <li class="btn btn-outline-dark active" data-filter="*">All</li>
                <li class="btn btn-outline-dark" data-filter=".climatech">Climatech</li>
                <li class="btn btn-outline-dark" data-filter=".ch">Counsel Hour</li>
                <li class="btn btn-outline-dark" data-filter=".sih">Self Investment Hour</li>
                <li class="btn btn-outline-dark" data-filter=".olymtwo">Sports Team</li>
                <li class="btn btn-outline-dark" data-filter=".iftar">Iftar Drive</li>
                <li class="btn btn-outline-dark" data-filter=".plant">Plantation Drive</li>
                <li class="btn btn-outline-dark text" data-filter=".other">Others</li>
            </ul>
        </div>
        <div class="portfolio-item row">
        <?php foreach ($images as $image): ?>
            <div class="item <?php echo htmlspecialchars($image['category']); ?> col-lg-3 col-md-4 col-6 col-sm">
                <a href="./<?php echo htmlspecialchars($image['url']); ?>" class="fancylight popup-btn" data-fancybox-group="<?php echo htmlspecialchars($image['category']); ?>">
                    <img class="img-fluid" src="./<?php echo htmlspecialchars($image['url']); ?>" alt="<?php echo htmlspecialchars($image['alt_text']); ?>">
                </a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</main>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Isotope -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
<!-- Custom JS -->
<script src="./gui/js/gallery.js"></script>
