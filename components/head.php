<?php

function renderHead($page, $postTitle = '', $postDescription = '', $postImage = '')
{
    $seoData = [
        'home' => [
            'title' => 'Home - Cüneyt Kaya Web Development',
            'description' => 'Welcome to Cüneyt Kaya\'s official website. Specializing in web development services.',
            'keywords' => 'home, web development, services',
            'image' => 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ],
        'about' => [
            'title' => 'About Me - Cüneyt Kaya',
            'description' => 'Learn more about Cüneyt Kaya, a professional web developer with years of experience.',
            'keywords' => 'about, Cüneyt Kaya, web developer, experience',
            'image' => 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ],
        'portfolio' => [
            'title' => 'Portfolio - Cüneyt Kaya Web Development',
            'description' => 'Check out my portfolio showcasing various web development projects.',
            'keywords' => 'portfolio, previous works, web development, projects, showcase',
            'image' => 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ],
        'contact' => [
            'title' => 'Contact - Cüneyt Kaya Web Development',
            'description' => 'Get in touch with Cüneyt Kaya for professional web development services.',
            'keywords' => 'contact, web development, get in touch, services',
            'image' => 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ],
        'blog' => [
            'title' => 'Blog - Cüneyt Kaya Web Development',
            'description' => 'Explore the latest blog posts on web development and design by Cüneyt Kaya.',
            'keywords' => 'blog, web development, design, tutorials',
            'image' => 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ],
        'imprints' => [
            'title' => 'Imprint - Cüneyt Kaya Web Development',
            'description' => 'Get more info about the business of Cüneyt Kaya Web Design.',
            'keywords' => 'imprint, business details, freelance',
            'image' => 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ],
        'privacy' => [
            'title' => 'Privacy Policy - Cüneyt Kaya Web Development',
            'description' => 'Get more info about the business of Cüneyt Kaya Web Design.',
            'keywords' => 'privacy, business details, freelance',
            'image' => 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ],
        'terms' => [
            'title' => 'Terms & Conditions - Cüneyt Kaya Web Development',
            'description' => 'Get more info about the business of Cüneyt Kaya Web Design.',
            'keywords' => 'terms, business details, freelance',
            'image' => 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ],
        'blog_post' => [
            'title' => $postTitle ? $postTitle . ' - Cüneyt Kaya Blog' : 'Blog Post - Cüneyt Kaya Blog',
            'description' => $postDescription ? $postDescription : 'Read this insightful blog post on international relations, sociology, politics and everything related to me.',
            'keywords' => 'blog, web development, design, tutorials',
            'image' => $postImage ? $postImage : 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg'
        ]
    ];

    $title = $seoData[$page]['title'] ?? 'Home - Cüneyt Kaya Web Development';
    $description = $seoData[$page]['description'] ?? 'Welcome to Cüneyt Kaya\'s official website.';
    $keywords = $seoData[$page]['keywords'] ?? 'web development, services';
    $image = $seoData[$page]['image'] ?? 'https://kayacuneyt.com/assets/images/laci-arkaplan.jpg';
    $url = 'https://kayacuneyt.com/' . $page;

    echo '
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="' . $description . '" />
        <meta name="author" content="Cüneyt Kaya" />
        <meta name="keywords" content="' . $keywords . '" />
        <meta name="robots" content="index, follow">
        <meta property="og:title" content="' . $title . '" />
        <meta property="og:description" content="' . $description . '" />
        <meta property="og:image" content="' . $image . '" />
        <meta property="og:url" content="' . $url . '" />
        <meta property="og:type" content="website" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="' . $title . '" />
        <meta name="twitter:description" content="' . $description . '" />
        <meta name="twitter:image" content="' . $image . '" />
        <meta name="twitter:url" content="' . $url . '" />
        <link rel="canonical" href="' . $url . '" />
        <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon" />
        <title>' . $title . '</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="/assets/css/styles.css" rel="stylesheet" />
    </head>';
}
?>
