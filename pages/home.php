<?php
$page = $_GET['page'] ?? 'home';

include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../components/head.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php renderHead($page); ?>
<body data-page="<?php echo $page; ?>" class="d-flex flex-column h-100 bg-light">

<?php
include_once __DIR__ . '/../components/navbar.php';
include_once __DIR__ . '/../components/home/header.php';
include_once __DIR__ . '/../components/home/features.php';
include_once __DIR__ . '/../components/home/services.php';
include_once __DIR__ . '/../components/video.php';
include_once __DIR__ . '/../components/home/testimonials.php';
include_once __DIR__ . '/../components/call_to_action.php';
include_once __DIR__ . '/../components/footer.php';
?>

</body>
</html>
