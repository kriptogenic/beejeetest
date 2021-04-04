<?php include 'head.php' ?>

<div class="row justify-content-center">
    <form class="col-md-6" method="post" action="<?= base_url('login-post');?>">
        <?php if ($error !== null): ?>
            <div class="alert alert-danger" role="alert"><?= htmlentities($error); ?></div>
        <?php endif; ?>
        <div class="form-group">
            <label for="inputName">Имя</label>
            <input name="login" type="text" class="form-control" id="inputName" required>
        </div>
        <div class="form-group">
            <label for="inputPassword">Пароль</label>
            <input name="password" type="password" class="form-control" id="inputPassword" required>
        </div>

        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>
<?php include 'foot.php' ?>
