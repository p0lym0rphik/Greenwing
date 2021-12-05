<section id="main" class="user-profile-container">
    <?= $this->avatar->render($user['id'], $user['username'], $user['name'], $user['email'], $user['avatar_path']) ?>
    <div class="panel">
        <ul>
            <li><?= t('Login:') ?> <strong><?= $this->text->e($user['username']) ?></strong></li>
            <li><?= t('Email:') ?> <strong><?= $this->text->e($user['email']) ?: t('None') ?></strong></li>
            <?= $this->hook->render('template:user:show:profile:info', array('user' => $user)) ?>
        </ul>
    </div>
</section>
