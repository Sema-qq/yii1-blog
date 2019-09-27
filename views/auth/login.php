<?php $this->view('error', ['user' => $user], true) ?>
<form class="form-signin" action="/auth/login" method="post">
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Вход</h1>
        <p>
            Если у Вас еще нет аккаунта в нашем приложении, то необходимо <a href="/auth/register">зарегистрироваться</a>.
        </p>
    </div>

    <div class="form-label-group">
        <label for="login"><?= $user->getLabel('login') ?></label>
        <input
            type="text"
            name="login"
            class="form-control"
            placeholder="<?= $user->getLabel('login') ?>"
            required=""
            autofocus=""
            value="<?= $user->login ?>"
            maxlength="15"
        >
    </div>

    <div class="form-label-group">
        <label for="password"><?= $user->getLabel('password') ?></label>
        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="<?= $user->getLabel('password') ?>"
            required=""
            value="<?= $user->password ?>"
            maxlength="15"
        >
    </div>
    <br>
    <button class="btn btn-lg btn-primary" type="submit">Войти</button>
    <p class="mt-5 mb-3 text-muted text-center">© 2019</p>
</form>
