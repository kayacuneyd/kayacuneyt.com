<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'contact';

include_once __DIR__ . '/../config/config.php';

include_once __DIR__ . '/../components/head.php';
renderHead($page);

include_once __DIR__ . '/../components/navbar.php';

include_once __DIR__ . '/../components/all_headers_desc.php';
include_once __DIR__ . '/../components/contact/contact_header.php';
include_once __DIR__ . '/../components/contact/contact_main.php';

?>

<div class="content"></div>

<?php
include_once __DIR__ . '/../components/footer.php';
?>