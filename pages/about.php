<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

include_once __DIR__ . '/../config/config.php';

include_once __DIR__ . '/../components/head.php';
renderHead($page);

include_once __DIR__ . '/../components/navbar.php';
include_once __DIR__ . '/../components/all_headers_desc.php';
include_once __DIR__ . '/../components/about/about_description.php';
include_once __DIR__ . '/../components/about/sections.php';
include_once __DIR__ . '/../components/call_to_action.php';
include_once __DIR__ . '/../components/about/section_team.php';

?>

<div class="content"></div>

<?php
include_once __DIR__ . '/../components/footer.php';
?>