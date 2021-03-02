<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 py-4 my-5 border border-1 border-secondary rounded-3">
        <div class="container">
            <?php if (session()->get('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <?php if (isset($validation)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger errorList" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif; ?>
            <form action="/user/login" method="post" class="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= set_value('username') ?>" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-dark w-75">Log In</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <a class="text-dark" href="/user/register">New user?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>