<?php
    global $adverts;
?>

<div class="row row-cols-1 row-cols-md-2 g-4">
    <?php foreach ($adverts as $advert): ?>
        <div class="col">
            <?php include(dirname(__DIR__).'\card.php');?>
        </div>
    <?php endforeach; ?>
</div>
