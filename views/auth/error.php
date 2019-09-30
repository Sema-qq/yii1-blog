<?php if ($user->hasErrors()): ?>
    <hr>
    <div class="alert alert-warning text-left" role="alert">
        <?php foreach ($user->getErrors() as $attribute => $errorMessage):?>
            <?= $user->getLabel($attribute) . ': ' . $errorMessage ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
