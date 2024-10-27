<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

include_once __DIR__ . '/../config/config.php';

include_once __DIR__ . '/../components/head.php';
renderHead($page);

include_once __DIR__ . '/../components/navbar.php';
include_once __DIR__ . '/../components/home/header.php';
include_once __DIR__ . '/../components/home/features.php';
include_once __DIR__ . '/../components/home/services.php';
include_once __DIR__ . '/../components/video.php';
include_once __DIR__ . '/../components/home/testimonials.php';
include_once __DIR__ . '/../components/call_to_action.php';

?>

<div class="content"></div>

<?php
include_once __DIR__ . '/../components/footer.php';
?>