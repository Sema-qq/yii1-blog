<form method="post" action="<?= $contact->id ? '/contact/edit/' . $contact->id : '/contact/create' ?>">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">
            <?= $contact->getLabel('name') ?>
            <span class="required">*</span>
        </label>
        <div class="col-sm-10">
            <input
                type="text"
                class="form-control"
                id="name"
                placeholder="<?= $contact->getLabel('name') ?>"
                name="name"
                value="<?= $contact->name ?>"
                maxlength="30"
                required
            >
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="col-sm-2 col-form-label"><?= $contact->getLabel('last_name') ?></label>
        <div class="col-sm-10">
            <input
                type="text"
                class="form-control"
                id="last_name"
                placeholder="<?= $contact->getLabel('last_name') ?>"
                name="last_name"
                value="<?= $contact->last_name ?>"
                maxlength="30"
            >
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">
            <?= $contact->getLabel('phone') ?>
            <span class="required">*</span>
        </label>
        <div class="col-sm-10">
            <input
                type="number"
                class="form-control"
                id="phone"
                placeholder="<?= $contact->getLabel('phone') ?>"
                name="phone"
                value="<?= $contact->phone ?>"
                maxlength="100"
                required
            >
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label"><?= $contact->getLabel('email') ?></label>
        <div class="col-sm-10">
            <input
                type="email"
                class="form-control"
                id="email"
                placeholder="<?= $contact->getLabel('email') ?>"
                name="email"
                value="<?= $contact->email ?>"
                maxlength="150"
            >
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </div>
</form>
