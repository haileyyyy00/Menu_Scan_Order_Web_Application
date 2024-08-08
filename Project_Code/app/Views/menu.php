<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<!-- Menu Workspace Header Section -->
<div class="container text-center mt-5 mb-4">
    <img src="<?= base_url('images/menu_workspace.png'); ?>" width="280" height="280" alt="user">
    <h2 class="mt-4">Menu Workspace</h2>
</div>

<!-- Menu Search and Add Section -->
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <!-- Search form for menus -->
            <form method="get" action="<?= base_url('viewmenu/'.esc($user_id, 'url')); ?>">
                <div class="input-group justify-content-center">
                    <input type="text" class="form-control" placeholder="Which menu are you looking for..." name="search">
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-md-end mb-2">
            <!-- Button for adding a new menu -->
            <a class="btn btn-outline-dark btn-lg" href="<?= base_url('viewmenu/menuaddedit/' . esc($user_id, 'url')); ?>"><i class="fa-solid fa-circle-plus"></i>&nbsp;Menu</a>
        </div>
    </div>
</div>

<!-- Flash Messages Section -->
<section class="py-3">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>&nbsp;<?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>&nbsp;<?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Display Menu Cards -->
<div class="container">
    <?php foreach($menus as $menu): ?>
    <div class="card text-center rounded mb-5 shadow-lg" id="menuCard">
        <div class="card-header bg-dark">
            <h1 style="color: white;"><?= esc($menu['name']) ?></h1>
        </div>
        <div class="card-body mb-3 bg-transparent">
            <h3 class="card-title mb-3"><?= esc($menu['remarks']) ?></h3>
            <h5 class="mb-3">Created on <?= esc($menu['created_on']) ?></h5>
            <div>
                <!-- Hidden inputs for menu and user IDs -->
                <input type="hidden" class="menu-id" value="<?= esc($menu['menu_id']) ?>">
                <input type="hidden" class="user-id" value="<?= esc($user_id) ?>">
                <!-- Buttons for viewing, editing, and deleting menu -->
                <a class="btn btn-outline-info btn-lg view-menu-item" href="<?= base_url('viewmenuitems/'. esc($menu['menu_id'], 'url')); ?>"><i class="bi bi-eye"></i></a>
                <a class="btn btn-outline-primary btn-lg edit-menu" href="<?= base_url('viewmenu/menuaddedit/'. esc($user_id, 'url') . '/' . esc($menu['menu_id'], 'url')); ?>"><i class="bi bi-pencil-fill"></i></a>
                <a class="btn btn-outline-danger btn-lg delete-menu" href="<?= base_url('viewmenu/menudelete/'. esc($user_id, 'url') . '/' . esc($menu['menu_id'], 'url')); ?>"><i class="bi bi-archive"></i></a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?= $pager->Links('default', 'pagination_view') ?>
<br><br><br>

<?= $this->endSection() ?>
