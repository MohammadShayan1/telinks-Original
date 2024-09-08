<?php

$PageTitle="TE-Links || Member";

function customPageHeader(){?>
  <link rel="stylesheet" href="../css/member.css">
<?php }

include_once('header.php');
?>
        <main>
            <section class="py-5">
                <div class="container" data-aos="fade-up"
                data-aos-duration="1000">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <span class="text-muted">Become a Member</span>
                            <h2 class="display-6 fw-bold">Member Benefits</h2>
                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia totam recusandae voluptatibus quam!</p>
                            <div class="row pt-3 pt-lg-4">
                                <div class="col-sm-6">
                                    <div class="mb-sm-0 mb-3">
                                        <div class="text-muted">
                                            <svg class="bi bi-aspect-ratio" fill="currentColor" height="48" viewbox="0 0 16 16" width="48" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"></path>
                                            <path d="M2 4.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v2.5a.5.5 0 0 1-1 0v-3zm12 7a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H13V8.5a.5.5 0 0 1 1 0v3z"></path></svg>
                                        </div>
                                        <h5 class="my-3">Responsive Design</h5>
                                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-sm-0 mb-3">
                                        <div class="text-muted">
                                            <svg class="bi bi-emoji-wink" fill="currentColor" height="48" viewbox="0 0 16 16" width="48" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                            <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm1.757-.437a.5.5 0 0 1 .68.194.934.934 0 0 0 .813.493c.339 0 .645-.19.813-.493a.5.5 0 1 1 .874.486A1.934 1.934 0 0 1 10.25 7.75c-.73 0-1.356-.412-1.687-1.007a.5.5 0 0 1 .194-.68z"></path></svg>
                                        </div>
                                        <h5 class="my-3">Easy-To-Use</h5>
                                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"><img alt="" class="img-fluid rounded" src="https://freefrontend.dev/assets/rectangle-wide.png"></div>
                    </div>
                </div>
            </section>
        </main>
        <?php
    function customPageFooter(){?>
        <script src="./js/member.js"></script>
        <?php
    }
    include_once('footer.php');

?>
