<h1>Просмотр контакта "<?= $contact->name ?>"</h1>
<hr>
<div class="container text-left">
    <a href="/contact/index" class="btn btn-default" style="border: 1px solid;">Контакты</a>
    <a href="/contact/edit/<?= $contact->id?>" class="btn btn-primary">Редактировать</a>
    <a href="/contact/delete/<?= $contact->id ?>" class="btn btn-danger">Удалить</a>
</div>
<br>
<table class="table" style="text-align: left">
    <tr>
        <td><?= $contact->getLabel('name') ?>:</td><td><?= $contact->name ?></td>
    </tr>
    <tr>
        <td><?= $contact->getLabel('last_name') ?>:</td><td><?= $contact->last_name ?></td>
    </tr>
    <tr>
        <td><?= $contact->getLabel('phone') ?>:</td><td><?= $contact->phone ?></td>
    </tr>
    <tr>
        <td><?= $contact->getLabel('email') ?>:</td><td><?= $contact->email ?></td>
    </tr>
</table>
