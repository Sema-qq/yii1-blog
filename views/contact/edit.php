<h1>Редактирование контакта контакта "<?= $contact->name ?>"</h1>
<?php $this->view('error', ['contact' => $contact], true) ?>
<hr>
<div class="container text-left">
    <a href="/contact/index" class="btn btn-default" style="border: 1px solid;">Контакты</a>
    <a href="/contact/edit/<?= $contact->id?>" class="btn btn-primary">Редактировать</a>
    <a href="/contact/delete/<?= $contact->id ?>" class="btn btn-danger">Удалить</a>
</div>
<br>
