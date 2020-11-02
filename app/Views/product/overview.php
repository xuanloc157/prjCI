<h2><?= esc($title); ?></h2>
<a href="/user/create">register</a><br>
<a href="/product/create">Create new item</a><br>
<?php if (!empty($product) && is_array($product)) : ?>
    
    <table border="1" id="tbl">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>infomation</th>
                <th>action</th>
            </tr>
            <thead>
               <tbody>
               <?php foreach ($product as $product_item) : ?>
                    <tr>

                        <td><?= esc($product_item['id']); ?></td>
                        <td><?= esc($product_item['name']); ?></td>
                        <td><?= esc($product_item['price']); ?></td>
                        <td><?= esc($product_item['review']); ?></td>
                        <td><a href="/product/<?= esc($product_item['id'], 'url'); ?>">View</a>
                            |<a href="/product/edit/<?= esc($product_item['id'], 'url'); ?>">Edit</a>
                            |<a href="/product/delete/<?= esc($product_item['id'], 'url'); ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
               </tbody>
    </table>
<?php else : ?>

    <h3>No Item</h3>
<?php endif ?>
<script>
    $(document).ready( function () {
    $('#tbl').DataTable();
} );
</script>