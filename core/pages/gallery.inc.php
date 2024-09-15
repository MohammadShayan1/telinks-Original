<?php
global $sql;
// Fetch images from the database
$query = $sql->query('SELECT * FROM images');
$images = $query->fetch_assoc();
?>
<main>
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="row pt-5">
            <div class="col-lg-12 text-center my-2">
                <h4>Gallery</h4>
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
            <?php if($images != null) { foreach ($images as $image): ?>
                <div class="item <?php echo htmlspecialchars($image['category']); ?> col-lg-3 col-md-4 col-6 col-sm">
                    <a href="../telinks/admin/<?php echo htmlspecialchars($image['url']); ?>" class="fancylight popup-btn"
                        data-fancybox-group="<?php echo htmlspecialchars($image['category']); ?>">
                        <img class="img-fluid" src="../telinks/admin/<?php echo htmlspecialchars($image['url']); ?>"
                            alt="<?php echo htmlspecialchars($image['alt_text']); ?>">
                    </a>
                </div>
            <?php endforeach; } ?>
        </div>
    </div>
</main>
