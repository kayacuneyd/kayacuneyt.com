<?php
$services = [
    [
        "title" => "Website Development",
        "description" => "Custom-built websites to suit your business or personal needs.",
        "icon" => "bi bi-collection"
    ],
    [
        "title" => "Website Maintenance",
        "description" => "Ongoing support and updates to keep your website running smoothly.",
        "icon" => "bi bi-building"
    ],
    [
        "title" => "Website Management",
        "description" => "Regular backups, performance optimization, and content management.",
        "icon" => "bi bi-toggles2"
    ],
    [
        "title" => "Content Management",
        "description" => "From blog posts to product descriptions, I ensure your content is optimized for SEO and aligns with your overall brand strategy.",
        "icon" => "bi bi-body-text"
    ]
];
?>

<section class="py-5 bg-light" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5" id="services">
            <div class="d-flex align-items-center col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0 display-5 color-ck-dark">What I can provide for you:</h2>
            </div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <?php foreach ($services as $service): ?>
                        <div class="col mb-5 h-100">
                            <div class="feature bg-ck bg-gradient text-white rounded py-1 px-2">
                                <i class="<?php echo $service['icon']; ?>" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                                    <h2 class="h5 mx-2 my-1 color-ck"><?php echo $service['title']; ?></h2>
                                </i>
                            </div>
                            <p class="mb-0 mt-2 fs-5">
                                <?php echo $service['description']; ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<img src="./assets/images/break-line-simple.svg" alt="simple line break" />
