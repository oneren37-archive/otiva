<?php
    global $advert
?>

<div class="card">
    <?php if ($advert["img"] != ""):?>
        <img src="<?php echo($advert["img"])?>" class="card-img-top" alt="image" />
    <?php endif;?>
    <div class="card-body">
        <p class="card-text"><?php echo($advert["date"])?></p>
        <h5 class="card-title"><?php echo($advert["title"])?></h5>
        <p class="card-text"><?php echo($advert["category"])?></p>
        <p class="card-text"><?php echo($advert["description"])?></p>
        <p class="card-text">Цена: <?php echo($advert["price"])?></p>
        <a href="/otiva/advert?aid=<?php echo($advert["aid"])?>" class="btn btn-primary">Посмотреть</a>
        <?php if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1):?>
            <button type="button" class="btn btn-danger" onclick="deleteAdvert(<?php echo($advert["aid"])?>)">
                Удалить
            </button>
        <?php endif;?>
    </div>
</div>

<script>
    function deleteAdvert(aid) {
        fetch('/otiva/delete-advert', {
            method: 'post',
            body: "aid="+aid,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
        })
            .then(() => {
                window.location.reload()
            })
    }
</script>