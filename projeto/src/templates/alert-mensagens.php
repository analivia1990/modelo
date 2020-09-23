<?php if ($msg) : ?>
    <div class="alert <?= $msg['classe'] ?>">
        <?= $msg['mensagem'] ?>
    </div>
<?php endif; ?>