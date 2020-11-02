<h2><?= esc($title); ?></h2>

<?= \Config\Services::validation()->listErrors(); ?>

<form action="/product/edit/<?= esc($product['id']); ?>" method="post">

    <input type="hidden" name="id" value="<?= esc($product['id']); ?>" />
    <label for="name">name</label>
    <input type="input" name="name" value="<?= esc($product['name']); ?>" /><br />
    <label for="price">price</label>
    <input type="input" name="price" value="<?= esc($product['price']); ?>" /><br />
    <label for="review">Text</label>
    <textarea name="review"><?= esc($product['review']);?></textarea><br />

    <input type="submit" name="submit" value="Edit item" />

</form>