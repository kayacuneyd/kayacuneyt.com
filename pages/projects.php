<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'projects';

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../components/head.php';
renderHead($page);

include_once __DIR__ . '/../components/navbar.php';


?>
<?php include_once __DIR__ . '/../components/projects/projects_header.php'; ?>
<div class="content">
    <?php include_once __DIR__ . '/../components/projects/projects_main.php'; ?>
</div>

<?php
include_once __DIR__ . '/../components/call_to_action.php';

include_once __DIR__ . '/../components/footer.php';
?>