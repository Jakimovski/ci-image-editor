<?= $this->extend('layouts/main') ?>

<?= $this->section('custom_css') ?>

<style>
    html,
    body {
        height: 100%;
    }

    .header {
        padding: auto;
        min-height: 90%;
        height: 90%;
    }

    .header div {
        padding-top: 10%;

        overflow: hidden;
    }

    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>


<?= $this->endSection() ?>


<?= $this->section('header') ?>

<div class="bg-secondary text-white header">
    <div class="container text-center">
        <h1>Image Editor</h1>
        <p class="lead">Powerful editor that can transform your photos in a matter of seconds.</p>
        <a href="/dashboard" class="btn btn-primary btn-lg">Get Started</a>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Image Editor 2020</p>
    </div>
    <!-- /.container -->
</footer>

<?= $this->endSection() ?>