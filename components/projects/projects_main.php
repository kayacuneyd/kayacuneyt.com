<?php

$jsonData = file_get_contents('data/projects.json');
$projects = json_decode($jsonData, true);

?>

<section class="py-4">
        <div class="container d-flex justify-content-evenly">

        <?php
        
        foreach ($projects['projects'] as $project) {
            echo '
                
                    <div class="col-2 mb-4">
                        <div class="card h-100">
                            <img src="' . $project['projectImage'] . '" class="card-img-top w-100" style="height: 125px; object-fit: contain;" alt="' . $project['name'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $project['name'] . '</h5>
                                <p class="card-text">' . $project['description'] . '</p>
                                <a href="' . $project['link'] . '" target="_blank" class="btn bg-ck color-ck">View Project</a>
                            </div>
                        </div>
                    </div>
            ';
        }
        
        
        ?>
        
        </div>
</section>