<?php include 'head.php' ?>
<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <h3 class="text-center mb-3">Изменить задачу</h3>
    </div>
    <div class="col text-right">
        <a href="<?= base_url('');?>" class="btn btn-success">Главная</a>
        <?php include 'log-in-out-button.php' ?>
    </div>
</div>
<div class="row justify-content-center">
    <form class="col-md-9" method="post" action="<?= base_url('update');?>">
        <?php if ($error !== null): ?>
            <div class="alert alert-danger" role="alert"><?= htmlentities($error); ?></div>
        <?php endif; ?>
        <input name="id" type="hidden" value="<?= $task->id; ?>">
        <div class="form-group">
            <label for="inputName">Имя</label>
            <input name="name" type="text" class="form-control" id="inputName" value="<?= htmlentities($task->name); ?>" required>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input name="email" type="email" class="form-control" id="inputEmail" value="<?= htmlentities($task->email); ?>" required>
        </div>
        <div class="form-group">
            <label for="inputText">Текст</label>
            <textarea name="text" class="form-control" id="inputText" rows="5" required><?= htmlentities($task->text); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
</div>
<?php include 'foot.php' ?>
