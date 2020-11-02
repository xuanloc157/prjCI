<h2><?= esc($title); ?></h2>

<?= \Config\Services::validation()->listErrors(); ?>

<form action="/product/create" method="post">
    <?= csrf_field() ?>

    <label for="name">name</label>
    <input type="input" name="name" /><br />
    <label for="price">price</label>
    <input type="input" name="price" /><br />
    <label for="review">Text</label>
    <textarea name="review"></textarea><br />

    <input type="submit" name="submit" value="Create new item" />

</form>