<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

include_once __DIR__ . '/../config/config.php';

include_once __DIR__ . '/../components/head.php';
renderHead($page);

include_once __DIR__ . '/../components/navbar.php';
include_once __DIR__ . '/../components/imprints/main_imprints.php';
?>

<div class="content"></div>

<?php
include_once __DIR__ . '/../components/footer.php';
?>