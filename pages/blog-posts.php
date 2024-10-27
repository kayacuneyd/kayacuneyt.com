<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/parsedown/Parsedown.php';

$postSlug = isset($_GET['post']) ? $_GET['post'] : '';

if (!$postSlug) {
    echo 'Blog post not specified.';
    exit;
}

$blogFilePath = __DIR__ . '/../data/blog/' . $postSlug . '.md';

if (file_exists($blogFilePath)) {
    $markdownContent = file_get_contents($blogFilePath);
    
    $Parsedown = new Parsedown();
    $htmlContent = $Parsedown->text($markdownContent);
    
    echo '
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-9">
                    <!-- Post content -->
                    <article>
                        <section class="mb-5">
                            ' . $htmlContent . '
                        </section>
                    </article>
                </div>
            </div>
        </div>
    </section>';
} else {
    echo '<p>Blog post not found.</p>';
}
?>