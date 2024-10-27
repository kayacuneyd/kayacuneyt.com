<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

include_once __DIR__ . '/../config/config.php';

include_once __DIR__ . '/../components/head.php';
renderHead($page);

include_once __DIR__ . '/../components/navbar.php';
?>

<div class="vh-100">
    <section class="py-5">
        <div class="container px-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xxl-6">
                    <div class="my-5">
                        <h1 class="fw-bolder mb-3 color-ck-dark fs-2">
                            Oooppss!
                        </h1>
                        <br>
                        <h2 class="fw-bolder mb-3 color-ck-dark">
                            404 - PAGE NOT FOUND
                        </h1>
                        <p class="lead color-ck-dark text-muted mb-4">
                            Sorry, the page you are looking for doesn't exist.
                            The link might be broken or the page may have been removed as well.
                        </p>

                        <nav class="blog-pagination" aria-label="Direction">
                            <a class="btn bg-ck color-ck rounded-pill" href="/">Go to Homepage</a>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php
include_once __DIR__ . '/../components/footer.php';
?>