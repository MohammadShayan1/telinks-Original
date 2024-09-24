<?php
global $sql;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    if (isset($nname) && isset($nemail)) {
        $sql->query("INSERT INTO newsletter (n_name, n_email) VALUES ('{$sql->escape($nname)}', '{$sql->escape($nemail)}')");
    }
}
// Create a new instance of the sql class
$db = new sql();

// Fetch events from the database
$query = $db->query("SELECT * FROM events ORDER BY date_from ASC");


?>


<main>
    <!-- Hero -->
    <section class="pb-5" id="hero">
        <div class="slider" id="slider" style="--img-prev:url(./gui/imgs/olympiad.jpg);">
            <div class="slider__content" id="slider-content">
                <div class="slider__images">
                    <div class="slider__images-item slider__images-item--active" data-id="1"><img
                            src="./gui/imgs/welcome.webp" /></div>
                    <div class="slider__images-item" data-id="2"><img src="./gui/imgs/olympiad.jpg" /></div>
                    <div class="slider__images-item" data-id="3"><img src="./gui/imgs/comingsoon.jpeg" /></div>
                    <!-- <div class="slider__images-item" data-id="4"><img src="https://lh3.googleusercontent.com/7MsdX710gvwl8YRxuiPIlIbGP8d3ypDASWqIOad9SpHHAPwMATjCoftyvoHjpy9eeD8aJVxVup-Zb02QMeBSFOXyqOlVc8ib3TVIXtktozy6sJK07H8Jo8UlJSpYcfgUq83Z5rJOiGQQAaZPhRYUcCR0aenU8Eh8aTuqvttfZA-PjsU39q5_I1HcpWDF1mXIxJTmlGqsoQNIuL75GDE-I2im2tAjEk6bkJkJEbDntxB5cLJEfV8TuKRsQwenkiN5opF4ttHGXYtJlS7adu-IO4wVIFcEOzdx4c1Eri3O6f9qjsTpXQH3BmpkTaLAtL5xzJit9qa0a4Dp-aZOZp1QzWeB6-dLM5HRxSiPFkku3S1umwm_GBeY3glxd3Ftata1mFIxpis6gR76oTiNO33vjxn1UZXYhCQUDByGyyuE6WOoPtu9iXJxfmUF9UMXiXVl7qyH-U7NJmq18qcU0Q6U7H3VucD_d2Vg8WTZmqVq7aA4jQ7MLuQASgMZIerxgwV_aW98z7xsS8isHgF9rN4Qtez18OjyabQxRXlC6shvRTqTDCpt1MPlfBWwyR2BKO3dHzk7h8T5=w1600-h766"/></div>
                    <div class="slider__images-item" data-id="5"><img src="https://lh3.googleusercontent.com/lqd5x1eNHsfzWpPeHNPe4u-ycQh1LyxWLp_mXi8tLvQGh4aNCbANfSfSWQdqhQy7c2J2V3a4dGIw6tRcMJCpFvsRrLLpXcFgHIjWpCWoxtgWC--0tMjb6W-YYKJX55zIhS1omxmSGPuQx1sZtsAL-XnRiqXbEIjGX1A_vbDObqVEc8TP3nVsraN5xLtektJbccNriwqqZ2CqpiuHagXKCRt3oa7D8N2ZygR-i04o8YP2pHr6I0Z76R6lZj1HDY65Sj-mkPJpN6nWKY-V_6htmMndJRY615MHntdsfZ82k5_IBbJXxdIN5MjJvgk41eyFXxzTKIXSGms-itEbW7FqMlZT8bIAigDoXYub9rh-FjtfdmVRVdwIIngzFzJrJQBroyHPxW9kW2JjH8foZCzX5YMStsHvfm1s4uAhZtbwK4KI_-x9GuXI3-cCUmtuFdQ-E2z_l3Hom57dasvYj6tFcqhRS9X_popdYTxR-4IeSE-NAjp71LDevvejtAqQTvpIRMFhV9um8qOb-xkPRe0xSoR6-chA2cQE--cbFJiLxe6ywBIqW6lI-aSI9Kv924s-OfRUGz0u=w1600-h766"/></div> -->
                </div>
                <div class="slider__text">
                    <div class="slider__text-item slider__text-item--active" data-id="1">
                        <div class="slider__text-item-head">
                            <h3></h3>
                        </div>
                        <div class="slider__text-item-info">
                            <p></p>
                        </div>
                    </div>
                    <div class="slider__text-item " data-id="2">
                        <div class="slider__text-item-head">
                            <h3></h3>
                        </div>
                        <div class="slider__text-item-info">
                            <p>“Bound by passion, fueled by dedication, we triumph as one”</p>
                        </div>
                    </div>
                    <div class="slider__text-item" data-id="3">
                        <div class="slider__text-item-head">
                            <h3></h3>
                        </div>
                        <div class="slider__text-item-info">
                            <p>“United in purpose, unstoppable in action, we conquer together”</p>
                        </div>
                    </div>
                    <!-- <div class="slider__text-item" data-id="4">
                      <div class="slider__text-item-head">
                        <h3>   </h3>
                      </div>
                      <div class="slider__text-item-info">
                        <p>“ ”</p>
                      </div>
                    </div>
                    <div class="slider__text-item" data-id="5">
                      <div class="slider__text-item-head">
                        <h3>Peaks</h3>
                      </div>
                      <div class="slider__text-item-info">
                        <p>“On all the peaks lies peace”</p>
                      </div>
                    </div> -->
                </div>
            </div>
            <div class="slider__nav">
                <div class="slider__nav-arrows">
                    <div class="slider__nav-arrow slider__nav-arrow--left" id="left">to left</div>
                    <div class="slider__nav-arrow slider__nav-arrow--right" id="right">to right</div>
                </div>
                <div class="slider__nav-dots" id="slider-dots">
                    <div class="slider__nav-dot slider__nav-dot--active" data-id="1"></div>
                    <div class="slider__nav-dot" data-id="2"></div>
                    <div class="slider__nav-dot" data-id="3"></div>
                    <!-- <div class="slider__nav-dot" data-id="4"></div>
                    <div class="slider__nav-dot" data-id="5"></div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- About -->
    <section class="py-5 about text-center">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row mb-5">
                <h2 class="display-5 fw-bold">About Us</h2>
                <p class="lead">At TE-Links, we're dedicated to nurturing talents and shaping futures. Through
                    mentorship, technical expertise, and advocacy, we empower students at NEDUET's Telecommunications
                    division to thrive in an ever-evolving world.</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>OUR VISION</h3>
                    <p class="lead"><q> TE-Links at NEDUET's Telecommunications division focuses on skill development,
                            mentorship, and career guidance, advocating for societal issues campus-wide </q></p>
                </div>
                <div class="col-md-6 ">
                    <h3>OUR MISSION</h3>
                    <p class="lead"><q> TE-Links mentors students, provides technical knowledge, and encourages dynamic
                            thinking through seminars and counseling, enhancing their skill sets </q></p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center">
        <hr class="hr-text" data-content="">
    </section>
    <!-- Upcoming events section -->
<section class="py-5">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center text-center mb-4 mb-md-5">
            <div class="col-xl-9 col-xxl-8">
                <h2 class="display-5 fw-bold">Upcoming Events</h2>
                <p class="lead"><q>Exciting events ahead: fun conferences and cool gatherings! Get ready for some awesome times!</q></p>
            </div>
        </div>
        <div class="row align-items-center gy-md-5">
            <?php if ($db->num_rows($query) > 0): ?>
                <?php while ($event = $db->fetch_assoc($query)): ?>
                    <div class="col-md-6">
                        <div class="mt-4 mt-md-0 text-center"><img alt="" class="img-fluid rounded my-md-0 my-4 w-75" src="<?php echo $event['image_url']; ?>"></div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="fw-semibold my-1"><?php echo $event['title']; ?></h2>
                        <div class="text-muted">
                            <?php echo date('jS F', strtotime($event['date_from'])) . " - " . date('jS F Y', strtotime($event['date_to'])); ?>
                        </div>
                        <p class="my-4"><?php echo $event['description']; ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No Upcoming Events For Now :)</p>
            <?php endif; ?>
        </div>
    </div>
</section>
    <section class="text-center">
        <hr class="hr-text" data-content="">
    </section>
    <!-- Testimonials -->
    <!-- Gallery -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row justify-content-center text-center mb-3 mb-md-5">
                <div class="col-lg-8 col-xxl-7">
                    <h2 class="display-5 fw-bold mb-3">Past Events</h2>
                    <p class="lead">From thought-provoking debates to creative showcases, our university society
                        sparks inspiration at every event.</p>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-md-6 col-xl-4"><img alt="" class="img-fluid rounded" src="./gui/imgs/past_event_5.jpg">
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="bg-light rounded h-100 d-flex align-items-center">
                        <div class="text-center p-5 p-md-3">
                            <h4>Ramadan Iftar Drive</h4>
                            <p class="mt-3 mb-0">Gathering at dusk, breaking fast together, and weaving memories
                                into every bite.</p>
                            <a href="Gallery.php" class="btn btn-dark">Go to Gallery</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4"><img alt="" class="img-fluid rounded" src="./gui/imgs/past_event_2.jpg">
                </div>
                <div class="col-md-6 col-xl-4"><img alt="" class="img-fluid rounded" src="./gui/imgs/past_event.jpg">
                </div>
                <div class="col-md-6 col-xl-4"><img alt="" class="img-fluid rounded" src="./gui/imgs/past_event_3.jpg">
                </div>
                <div class="col-md-6 col-xl-4"><img alt="" class="img-fluid rounded" src="./gui/imgs/past_event_4.jpg">
                </div>
            </div>
        </div>
    </section>
    <section class="text-center">
        <hr class="hr-text" data-content="">
    </section>
    <!-- F.A.Q -->
    <section class="py-5">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row justify-content-center text-center mb-3">
                <div class="col-lg-8 col-xl-7">
                    <h2 class="display-5 fw-bold">Frequently Asked Questions</h2>
                    <p class="lead">Explore our most common inquiries below to understand how TE-Links can help you grow and connect with like-minded individuals. From event details to membership opportunities, find everything you need to know right here!</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <!-- <span class="text-muted">Lorem ipsum dolor</span> -->
                    <h2 class="pb-4 fw-bold">Have Any Questions?</h2>
                    <p>At TE-Links, we value open communication and are here to assist you with any inquiries, whether about our society, upcoming events, or membership opportunities. Whether you're a student looking for guidance or an industry professional seeking collaboration, feel free to reach out. Let's connect and build a brighter future in telecommunications and technology together!.</p><a class="btn btn-dark btn-lg mt-3"
                        href="./Contact">Contact us</a>
                </div>
                <div class="col-md-7">
                    <div class="accordion" id="Questions-accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="Questions-headingOne"><button
                                    aria-controls="Questions-collapseOne" aria-expanded="false"
                                    class="accordion-button collapsed bg-light" data-bs-target="#Questions-collapseOne"
                                    data-bs-toggle="collapse" type="button">
                                    <div class="text-muted me-3">
                                        <svg class="bi bi-question-circle-fill" fill="currentColor" height="24"
                                            viewbox="0 0 16 16" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                            </path>
                                        </svg>
                                    </div>What is the purpose of the society?
                                </button></h2>
                            <div aria-labelledby="Questions-headingOne" class="accordion-collapse collapse"
                                data-bs-parent="#Questions-accordion" id="Questions-collapseOne">
                                <div class="accordion-body">
                                    - The society aims to connect students with similar interests, provide networking
                                    opportunities, and organize events and activities.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="Questions-headingTwo"><button
                                    aria-controls="Questions-collapseTwo" aria-expanded="false"
                                    class="accordion-button collapsed bg-light" data-bs-target="#Questions-collapseTwo"
                                    data-bs-toggle="collapse" type="button">
                                    <div class="text-muted me-3">
                                        <svg class="bi bi-question-circle-fill" fill="currentColor" height="24"
                                            viewbox="0 0 16 16" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                            </path>
                                        </svg>
                                    </div>How can I join the society?
                                </button></h2>
                            <div aria-labelledby="Questions-headingTwo" class="accordion-collapse collapse"
                                data-bs-parent="#Questions-accordion" id="Questions-collapseTwo">
                                <div class="accordion-body">
                                    - You can join by signing up at our booth during the club fair or by filling out the
                                    membership form on our website.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="Questions-headingThree"><button
                                    aria-controls="Questions-collapseThree" aria-expanded="false"
                                    class="accordion-button collapsed bg-light"
                                    data-bs-target="#Questions-collapseThree" data-bs-toggle="collapse" type="button">
                                    <div class="text-muted me-3">
                                        <svg class="bi bi-question-circle-fill" fill="currentColor" height="24"
                                            viewbox="0 0 16 16" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                            </path>
                                        </svg>
                                    </div>What types of events does the society host?
                                </button></h2>
                            <div aria-labelledby="Questions-headingThree" class="accordion-collapse collapse"
                                data-bs-parent="#Questions-accordion" id="Questions-collapseThree">
                                <div class="accordion-body">
                                    - We host a variety of events including guest lectures, workshops, social
                                    gatherings, and field trips.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="Questions-headingFour"><button
                                    aria-controls="Questions-collapseFour" aria-expanded="false"
                                    class="accordion-button collapsed bg-light" data-bs-target="#Questions-collapseFour"
                                    data-bs-toggle="collapse" type="button">
                                    <div class="text-muted me-3">
                                        <svg class="bi bi-question-circle-fill" fill="currentColor" height="24"
                                            viewbox="0 0 16 16" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z">
                                            </path>
                                        </svg>
                                    </div>Do I need any prior experience to join?
                                </button></h2>
                            <div aria-labelledby="Questions-headingFour" class="accordion-collapse collapse"
                                data-bs-parent="#Questions-accordion" id="Questions-collapseFour">
                                <div class="accordion-body">
                                    - No prior experience is necessary. We welcome members of all skill levels and
                                    backgrounds.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Past Sponsors -->
    <section class="py-5 oursponsors">
        <div class="row text-center">
            <h2 class="display-5 fw-bold">Our Past Partners</h2>
        </div>
        <div class="marquee" data-aos="fade-up" data-aos-duration="1000">
            <div class="platform-inner">
                <div class="platform-list">
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/auspak.png" alt="sponsor1">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/barqtron.png" alt="sponsor2">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/blue.png" alt="sponsor3">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/british-council.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/businesssolutions.png"
                            alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/digitek.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/mdpi.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/DreamBig.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/neduet.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/Nunami.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/ptcl.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/ramada.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/telec-logo.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/telec-logo.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/the-doodle-club.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/times-consultant.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/ubl-blue.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/Ufone.png" alt="sponsor4">
                    </div>
                    <div class="col-md-3 col-6">
                        <img class="img-fluid imggreyout" src="./gui/imgs/sponsors/xceleruim.png" alt="sponsor4">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter -->
    <section class="py-5 my-md-5" id="newsletter">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <span class="text-muted">Newsletter</span>
                        <h2 class="display-5 fw-bold">Subscribe Today</h2>
                        <p class="lead"><q>Stay ahead of the curve with the latest updates from the world of telecommunications, AI, and green technology. Our newsletter brings you exclusive insights from industry experts, alumni experiences, and upcoming society events. Subscribe now to be part of our growing community, where knowledge and innovation thrive!.</q></p>
                        <div class="mx-auto mt-3">
                            <form action="" role="form" class="row g-3" method="post" id="newsletterForm">
                                <div class="col-md-4">
                                    <input class="form-control bg-light" placeholder="Full name" name="nname"
                                        type="text" required>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control bg-light" placeholder="Email address" name="nemail"
                                        type="email" required>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-grid">
                                        <button class="btn btn-dark" type="submit">Subscribe</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="./gui/js/main.js"></script>