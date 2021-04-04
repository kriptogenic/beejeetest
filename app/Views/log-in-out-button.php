<?php if ($authorized): ?>
    <a href="<?= base_url('logout');?>" class="btn btn-danger">Выйти</a>
<?php else: ?>
    <a href="<?= base_url('login');?>" class="btn btn-primary">Войти</a>
<?php endif; ?>