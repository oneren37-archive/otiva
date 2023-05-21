<?php
    global $advert;
?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование товара</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-title" class="col-form-label">Название</label>
                        <input value="<?php echo($advert["title"])?>" type="text" class="form-control" id="recipient-title">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-desc" class="col-form-label">Описание</label>
                        <textarea class="form-control" id="recipient-desc" rows="10"><?php echo($advert["description"])?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-price" class="col-form-label">Цена</label>
                        <input value="<?php echo($advert["price"])?>" type="number" class="form-control" id="recipient-price">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                <button type="button" class="btn btn-primary">Редактировать</button>
            </div>
        </div>
    </div>
</div>

<script>
    console.log("i'm here")
</script>