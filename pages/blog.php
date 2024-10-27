<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

include_once __DIR__ . '/../config/config.php';

include_once __DIR__ . '/../components/head.php';

$jsonData = file_get_contents(__DIR__ . '/../data/blog_posts.json');
$blogPosts = json_decode($jsonData, true); 

$postSlug = isset($_GET['post']) ? $_GET['post'] : '';

if ($postSlug) {
    $post = null;
    foreach ($blogPosts['posts'] as $blogPost) {
        if ($blogPost['slug'] === $postSlug) {
            $post = $blogPost;
            break;
        }
    }

    if ($post) {
        $postTitle = htmlspecialchars($post['title']);
        $postDescription = isset($post['description']) ? htmlspecialchars($post['description']) : '';
        $postImage = htmlspecialchars($post['postImage']);

        renderHead('blog_post', $postTitle, $postDescription, $postImage);

        include_once __DIR__ . '/../components/navbar.php';

        $author = htmlspecialchars($post['author']);
        $date = htmlspecialchars($post['date']);

        $contentFilePath = __DIR__ . '/../' . $post['contentFile'];
        if (file_exists($contentFilePath)) {
            $content = file_get_contents($contentFilePath);

            if (pathinfo($contentFilePath, PATHINFO_EXTENSION) === 'md') {
                require_once __DIR__ . '/../vendor/parsedown/Parsedown.php'; 
                $Parsedown = new Parsedown();
                $content = $Parsedown->text($content); 
            }
        } else {
            $content = '<p>Content not available.</p>';
        }

        $categories = '';
        foreach ($post['categories'] as $category) {
            $categories .= '<a class="badge bg-secondary text-decoration-none link-light" href="#!">' . htmlspecialchars($category) . '</a> ';
        }

        echo '
        <main>
            <section class="py-5">
                <div class="container">
                    <div class="row gx-5">
                        <div class="col">
                            <article class="blog-post">
                                <header class="custom-page-header pb-3 pt-4 border-bottom">
                                    <div class="container mx-2">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="page-title-heading">
                                                    <h1 class="fs-2 fw-bold">' . $postTitle . '</h1>
                                                    <p>' . $postDescription . '</p>
                                                    <p>
                                                        <span class="badge bg-ck color-ck">' . $date . '</span> 
                                                        by <a class="text-decoration-none color-ck-dark fw-2" href="/about" title="Posts by ' . $author . '" rel="author">' . $author . '</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <img class="img-fluid rounded" src="' . $postImage . '" alt="' . $postTitle . '">
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                
                                <!-- Post content -->
                                <section class="my-5">
                                    <div class="container mx-1">
                                    <div class="row">
                                        ' . $content . '
                                    </div>
                                    </div>
                                </section>
                            </article>
                        </div>
                    </div>
                    <nav class="blog-pagination" aria-label="Direction">
                        <a class="btn bg-ck color-ck rounded-pill" href="/blog">Go to Blog Page</a>
                    </nav>
                </div>
            </section>
        </main>';
    } else {
        echo '<p>Blog post not found.</p>';
    }
} else {
    renderHead('blog');
    include_once __DIR__ . '/../components/navbar.php';

    echo '<section class="py-5">';
    echo '<div class="container px-5 my-5">';
    echo '<h1 class="fw-bolder mb-5 color-ck-dark">Blog Posts</h1>';
    echo '<div class="row gx-5">';

    foreach ($blogPosts['posts'] as $blogPost) {
        $title = htmlspecialchars($blogPost['title']);
        $author = htmlspecialchars($blogPost['author']);
        $date = htmlspecialchars($blogPost['date']);
        $slug = htmlspecialchars($blogPost['slug']);
        $thumbnail = htmlspecialchars($blogPost['postImage']);

        $excerpt = strip_tags(file_get_contents(__DIR__ . '/../' . $blogPost['contentFile']));
        $excerpt = substr($excerpt, 0, 100) . '...';

        $category = htmlspecialchars($blogPost['categories'][0]); // 

        echo '
          <a href="/blog/' . $slug . '" class="text-decoration-none color-ck-dark">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-success-emphasis">' . $category . '</strong>
                    <h3 class="mb-0">' . $title . '</h3>
                    <div class="mb-1 text-body-secondary">' . $date . '</div>
                    <p class="mb-auto">' . $excerpt . '</p>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img src="' . $thumbnail . '" class="bd-placeholder-img" width="427/640" height="auto" alt="Thumbnail">
                </div>
            </div>
          </a>';
    }

    echo '</div>';
    echo '</div>';
    echo '</section>';
}

include_once __DIR__ . '/../components/footer.php';
?>
