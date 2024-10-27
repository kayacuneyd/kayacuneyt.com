<?php
$pageContent = [
    'imprint' => [
        'title' => 'Imprint',
        'content' => [
            [
                'sectionTitle' => 'Information according to § 5 TMG (German Telemedia Act)',
                'description' => ''
            ],
            [
                'sectionTitle' => 'Cüneyt Kaya',
                'description' => 'Roßbergstr. 12, Kornwestheim, 70806, Germany'
            ],
            [
                'sectionTitle' => 'Contact',
                'description' => 'Email: info@kayacuneyt.com<br>Website: https://kayacuneyt.com'
            ],
            [
                'sectionTitle' => 'Business Operations',
                'description' => 'Business operations are managed in partnership with Xolo Go OÜ, registry code 14717109, located at Kalasadama 4, Tallinn, Republic of Estonia.'
            ],
            [
                'sectionTitle' => 'Responsible for Content',
                'description' => 'Cüneyt Kaya'
            ]
        ]
    ]
];

$imprintContent = $pageContent['imprint'];
?>

<div class="content">
    <section class="py-5">
        <div class="container px-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xxl-6">
                    <div class="my-5">
                        <h1 class="fw-bolder mb-3 color-ck-dark">
                            <?php echo htmlspecialchars($imprintContent['title']); ?>
                        </h1>

                        <?php foreach ($imprintContent['content'] as $section): ?>
                            <h2 class="fw-bolder mb-3 color-ck-dark">
                                <?php echo htmlspecialchars($section['sectionTitle']); ?>
                            </h2>
                            <p class="lead color-ck-dark text-muted mb-4">
                                <?php echo $section['description']; ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>