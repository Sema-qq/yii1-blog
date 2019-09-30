<h1>Редактирование контакта "<a href="/contact/show/<?= $contact->id ?>"><?= $contact->name ?></a>"</h1>
<?php $this->view('error', ['contact' => $contact], true) ?>
<hr>
<div class="container text-left">
    <a href="/contact/index" class="btn btn-default" style="border: 1px solid;">Контакты &#8617;</a>
    <a href="/contact/show/<?= $contact->id?>" class="btn btn-secondary">Просмотр</a>
</div>
<hr>
<?php $this->view('_form', ['contact' => $contact], true) ?>
