<h1>Загрузка фото для контакта "<a href="/contact/show/<?= $contact->id ?>"><?= $contact->name ?></a>"</h1>
<?php $this->view('error', ['contact' => $uploader], true) ?>
<hr>
<div class="container text-left">
    <a href="/contact/index" class="btn btn-default" style="border: 1px solid;">Контакты &#8617;</a>
    <a href="/contact/show/<?= $contact->id?>" class="btn btn-secondary">Просмотр</a>
    <a href="/contact/edit/<?= $contact->id?>" class="btn btn-primary">Редактировать</a>
</div>
<hr>
<form method="post" action="/contact/photo/<?= $contact->id ?>" enctype=multipart/form-data>
    <div class="form-group row">
        <label for="file" class="col-sm-2 col-form-label">
            <?= $uploader->getLabel('file') ?>
            <span class="required">*</span>
        </label>
        <div class="col-sm-10">
            <input
                type="file"
                id="file"
                placeholder="<?= $uploader->getLabel('file') ?>"
                name="file"
                required
            >
        </div>
    </div>
    <hr>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </div>
</form>
