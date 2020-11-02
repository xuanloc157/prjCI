<?= \Config\Services::validation()->listErrors(); ?>
<form action="../../user/login" method="post">
<h2 style="color:red"><?php if (isset($error)) {
    echo $error;
} ?></h2>
<div>
Username:<input type="text" name="username"/>
</div>
<div>Pasword:<input type="password" name="password"/></div>
<input type="submit" value="Login"/>
</form>