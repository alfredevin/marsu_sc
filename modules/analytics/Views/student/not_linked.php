<?php
use Modules\Analytics\Support\Ui;
?>
<div class="container-fluid px-3 py-3">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:640px">
        <?= Ui::emptyState('Your account is not linked to a student record', 'Your login is not connected to an official student record yet, so there are no classes or grades to show. Please contact the Registrar to link your account.', 'bi-person-x') ?>
    </div>
</div>
