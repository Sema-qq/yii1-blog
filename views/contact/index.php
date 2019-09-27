<section class="jumbotron text-center" style="padding: 10px;">
    <div class="container">
        <h1 class="jumbotron-heading">Контакты</h1>
    </div>
</section>
<div class="container text-left">
    <a href="/contact/create" class="btn btn-primary">Добавить</a>
    <a
        href="/contact/index?sort=<?= $sort ?>"
        class="btn btn-default"
        style="border: 1px solid;"
    >Сортировать <?= $arrow ?></a>
</div>
<div class="album py-5">
    <div class="container">
        <div class="row">
            <?php if ($contacts): ?>
                <?php foreach ($contacts as $contact): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="contact-photo">
                                <?php if ($contact->photoExists()): ?>

                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?= $contact->name . $contact->last_name ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a
                                            href="/contact/show/<?= $contact->id ?>"
                                            class="btn btn-sm btn-outline-secondary contact-show"
                                        >Просмотр</a>
                                        <a
                                            href="/contact/edit/<?= $contact->id ?>"
                                            class="btn btn-sm btn-outline-secondary contact-edit"
                                        >Изменить</a>
                                        <a
                                            href="/contact/delete/<?= $contact->id ?>"
                                            class="btn btn-sm btn-outline-secondary contact-delete"
                                        >Удалить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="container">
                    <h1 class="jumbotron-heading">Контакты отсутствуют</h1>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
