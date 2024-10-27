<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$blogData = json_decode(file_get_contents('./blogData.json'), true);
$validPages = ['home', 'about', 'portfolio', 'contact', 'imprints', 'terms', 'privacy', 'projects']; 
if (in_array($page, $validPages)) {

    include './pages/' . $page . '.php';
    } elseif (array_key_exists($page, $blogData)) {
    
        $blogPost = $blogData[$page];
        include '/pages/blog.php'; 
    } else {
        
        header("Location: /pages/404.php");
        exit;
}


include_once __DIR__ . '/config/config.php';


switch ($page) {
    case 'portfolio':
        include __DIR__ . '/pages/portfolio.php';
        break;
    case 'about':
        include __DIR__ . '/pages/about.php';
        break;
    case 'contact':
        include __DIR__ . '/pages/contact.php';
        break;
    case 'terms':
        include __DIR__ . '/pages/terms.php';
        break;
    case 'imprints':
        include __DIR__ . '/pages/imprints.php';
        break;
    case 'privacy':
        include __DIR__ . '/pages/privacy.php';
        break;
    case 'projects':
        include __DIR__ . '/pages/projects.php';
        break;
    case '404':
        include __DIR__ . '/pages/404.php';
        break;
    case 'blog-posts':
        include __DIR__ . '/pages/blog-posts.php';
        break;
    case 'blog':
        include __DIR__ . '/pages/blog.php';
        break;
    default:
        include __DIR__ . '/pages/home.php';
        break;
}
