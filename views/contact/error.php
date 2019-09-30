<?php if ($contact->hasErrors()): ?>
    <hr>
    <div class="alert alert-warning text-left" role="alert">
        <?php foreach ($contact->getErrors() as $attribute => $errorMessage):?>
            <?= $contact->getLabel($attribute) . ': ' . $errorMessage ?><br>
        <?php endforeach; ?>
    </div>
<?php elseif ($errors = \components\Session::get(\models\Contact::ERROR_SESSION_KEY)): ?>
    <hr>
    <div class="alert alert-warning text-left" role="alert">
        <?php foreach ($errors as $attribute => $errorMessage):?>
            <?= $contact->getLabel($attribute) . ': ' . $errorMessage ?><br>
        <?php endforeach; ?>
    </div>
    <?php \components\Session::delete(\models\Contact::ERROR_SESSION_KEY) ?>
<?php endif; ?>
