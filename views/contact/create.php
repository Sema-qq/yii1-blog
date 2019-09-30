<h1>Создание контакта</h1>
<?php $this->view('error', ['contact' => $contact], true) ?>
<hr>
<div class="container text-left">
    <a href="/contact/index" class="btn btn-default" style="border: 1px solid;">Контакты &#8617;</a>
</div>
<hr>
<?php $this->view('_form', ['contact' => $contact], true) ?>
