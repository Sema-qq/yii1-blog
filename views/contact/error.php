<?php if ($contact->hasErrors()): ?>
    <div class="alert alert-warning text-left" role="alert">
        <?php foreach ($contact->getErrors() as $attributeLabel => $errorMessage):?>
            <?= $attributeLabel . ': ' . $errorMessage ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
