<?= \Config\Services::validation()->listErrors(); ?>
<form action="../../user/create" method="post">
    <h2 style="color:red"><?php if (isset($error)) {
    echo $error;
} ?></h2>
    <div>
        Username:<input type="text" name="username" />
    </div>
    <div>Pasword:<input type="password" name="password" /></div>
    <?php if ($_SESSION['user']['permission'] == "admin") :?>
    <select name="permission">
        <option value="admin">Admin</option>
        <option value="empPro">Employee Product</option>
        <option value="empRe">Employee Review</option>
    </select>
    <?php  endif;?>
    <input type="submit" value="register" />
</form>