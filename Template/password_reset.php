<div class="form-login">
    <h2><?= t('Password Reset') ?></h2>
    <form method="post" action="<?= $this->url->href('PasswordResetController', 'save') ?>">
        <?= $this->form->csrf() ?>

        <?= $this->form->label(t('Username'), 'username') ?>
        <?= $this->myFormHelper->text('username', $values, $errors, array('autofocus'), 'alert alert-error') ?>
        <p class="form-help"><?= t('Your profile must have a valid email address.') ?></p>

        <?= $this->form->label(t('Enter the text below'), 'captcha') ?>
        <img src="<?= $this->url->href('CaptchaController', 'image') ?>" alt="Captcha">
        <?= $this->myFormHelper->text('captcha', array(), $errors, array(), 'alert alert-error') ?>

        <div class="form-actions">
            <button type="submit" class="btn btn-blue"><?= t('Change Password') ?></button>
        </div>
    </form>
</div>
