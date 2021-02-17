<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12 mt-5 text-center">
        <h2>Hello,
            <?= session()->get('first_name') ?>
        </h2>
        <h2>The dashboard page is under constructon.</h2>
    </div>
</div>

<?= $this->endSection() ?>