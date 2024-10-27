<?php
include_once __DIR__ . '/../../data/aboutSectionsData.php';

foreach ($aboutSectionsData as $section) {
    $orderClass = $section['order'] === 'reverse' ? 'order-first order-lg-last' : '';
    $bgClass = !empty($section['bg_color']) ? $section['bg_color'] : '';
?>
    <section class="py-5 <?php echo $bgClass; ?>" id="scroll-target">
        <div class="container px-5 my-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 <?php echo $orderClass; ?>">
                    <img class="img-fluid rounded mb-5 mb-lg-0" src="<?php echo $section['image']; ?>" alt="<?php echo $section['title']; ?>" />
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bolder"><?php echo $section['title']; ?></h2>
                    <p class="lead fw-normal text-muted mb-0"><?php echo $section['text']; ?></p>
                </div>
            </div>
        </div>
            <img src="./assets/images/break-line-simple.svg" alt="simple line break" />
    </section>
<?php
}
?>