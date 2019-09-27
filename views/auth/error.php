<?php if ($user->hasErrors()): ?>
    <div class="alert alert-warning text-left" role="alert">
        <?php foreach ($user->getErrors() as $attributeLabel => $errorMessage):?>
            <?= $attributeLabel . ': ' . $errorMessage ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
