<?php
include_once __DIR__ . '/../data/quotesData.php';

$title = isset($quotesData[$page]['title']) ? $quotesData[$page]['title'] : 'A ship is safe in the harbor,';
$quote = isset($quotesData[$page]['quote']) ? $quotesData[$page]['quote'] : 'but it will never know the meaning of freedom unless it sails. The waves will challenge you, but remember, it’s not the wind that brings you to shore—it’s your sails.';
?>

<header class='py-5 bg-ck-light color-ck-dark'>
    <div class='container px-5'>
        <div class='row justify-content-center'>
            <div class='col-lg-8 col-xxl-6'>
                <div class='text-center my-5'>
                    <h1 class='fw-bolder mb-3'><?php echo $title; ?></h1>
                    <p class='lead fw-normal text-muted mb-4'><?php echo $quote; ?></p>
                </div>
            </div>
        </div>
    </div>
</header>