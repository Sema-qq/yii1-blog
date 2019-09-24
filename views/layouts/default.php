<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <script src="/assets/js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="wrap">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <?php if (\components\User::isGuest()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/signup">Зарегистрироваться</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/logout">
                            Выйти(<?= \components\User::getName() ?>)
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main role="main" class="container">
        <div class="starter-template">
            <?= $this->getContent() ?>
        </div>
    </main>
</div>
</body>
</html>
