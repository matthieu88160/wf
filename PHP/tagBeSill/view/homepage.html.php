<?php

$content = '<div class="container">';
$content .= '<div class="row">';

foreach ($projects as $key => $project) {
    $img = $project['image'];
    $title = $project['title'];
    $pubDate = $project['publishingDate'];
    $desc = $project['description'];
    $status = $project['label'];
    
    if ($pubDate === null) {
        continue;
    }
    if ($img === null || !file_exists(__DIR__.'/../public/'.$img)) {
        $img = '/img/no_image.png';
    }
    
    if (strlen($desc) > 200) {
        $desc = substr($desc, 0, 197) . '...';
    }
    
    $badgeType = 'success';
    if ($status == 'Blocked' || $status == 'Out of budget') {
        $badgeType = 'danger';
    } else if ($status == 'Analysis') {
        $badgeType = 'primary';
    }
    
    $categories = [];
    foreach ($project['categories'] as $category) {
        $categories[] = $category['label'];
    }
    $categories = implode(' | ', $categories);
    
    $content .= <<<EOT
    <div class="col-md-6 col-lg-3 my-3">
        <div class="card">
          <img class="card-img-top bg-secondary" src="$img" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">
                $title
                <span class="badge badge-$badgeType">$status</span>
            </h5>
            <p class="card-text">$desc</p>
            <p class="card-text"><small class="text-muted">$pubDate</small></p>
            <p class="card-text"><span class="badge badge-info">$categories</span></p>
          </div>
        </div>
    </div>
EOT;
}

$content .= '</div>';
$content .= '</div>';

$title = 'Tag be sill home page';

include __DIR__ . '/Base.html.php';











