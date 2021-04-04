<?php include 'head.php' ?>
<div class="row mb-2">
    <div class="col-lg-6 offset-lg-2">
        <h3 class="text-center mb-3">Список задач</h3>
    </div>
    <div class="col text-md-right">
        <a href="<?= base_url('add');?>" class="btn btn-success">Добавить задачу</a>
        <?php include 'log-in-out-button.php' ?>
    </div>
</div>
<form class="form-inline" method="get">
    <div class="input-group mb-2">
        <label for="inputSort">Сортировать по</label>
        <select name="sort" id="inputSort" class="form-control mx-2">
            <option value="none">Нет</option>
            <option value="name" <?= $sort == 'name' ? 'selected' :''; ?>>Имя</option>
            <option value="email" <?= $sort == 'email' ? 'selected' :''; ?>>Email</option>
            <option value="status" <?= $sort == 'status' ? 'selected' :''; ?>>Статус</option>
        </select>
    </div>
    <div class="input-group mb-2">
        <select name="order" class="form-control mr-2">
            <option value="asc" <?= $order == 'asc' ? 'selected' :''; ?>>Возрастанию</option>
            <option value="desc" <?= $order == 'desc' ? 'selected' :''; ?>>Убыванию</option>
        </select>
    </div>


    <button type="submit" class="btn btn-primary mb-2">Сортировать</button>
</form>
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Текст</th>
        <th>Статус</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= $task->id; ?></td>
            <td><?= htmlentities($task->name); ?></td>
            <td><?= htmlentities($task->email); ?></td>
            <td><?= htmlentities($task->text); ?></td>
            <td>
                <?php if ($task->status == 0): ?>
                    <span class="badge badge-danger">Невыполнен</span>
                <?php else: ?>
                    <span class="badge badge-success">Выполнен</span>
                <?php endif; ?>
                <?php if ($task->edited == 1): ?>
                <span class="badge badge-warning">изменён</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($authorized): ?>
                <?php if ($task->status == 0): ?>
                <a href="<?= base_url('done?task=' . $task->id);?>" class="btn btn-sm btn-success">Выполнить</a>
                <?php endif; ?>
                <a href="<?= base_url('edit?task=' . $task->id);?>" class="btn btn-sm btn-primary">Изменить</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php if ($pages > 1): ?>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
        <li class="page-item <?= $current == $i ? 'active' : ''; ?>">
            <a class="page-link" href="<?= base_url(sprintf("?page=%d&sort=%s&order=%s", $i, $sort, $order));?>"><?= $i ?></a>
        </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>
<?php include 'foot.php' ?>
