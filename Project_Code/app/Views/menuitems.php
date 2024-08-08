<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<!-- Menu Curator Header -->
<div class="container text-center mt-5 mb-4">
    <img src="<?= base_url('images/menucurator.png'); ?>" width="280" height="280" alt="user">
    <h2 class="mt-4">Menu Curator</h2>
</div>

<!-- Display Menu Name -->
<div class="container text-center">
    <div class="card text-white bg-dark mb-3" style="width: 100%;">
        <h1><?= esc($menu_name) ?></h1>
    </div>
</div>

<!-- Flash Messages Section -->
<section class="py-2">
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

<!-- Categories and Menu Items Section -->
<?php foreach($categories as $category): ?>
    <?php $current_category = $category['category']?>
    <div class="container mt-5 mb-3">
        <!-- Category Card -->
        <div class="card shadow-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h2 class="card-title mb-0"><?= esc($current_category) ?></h2>
                <!-- Edit and Delete Category Buttons -->
                <div>
                    <a href="<?= base_url('viewmenuitems/editcategory/' . esc($menu_id) . '/' . esc($current_category));?>" class="btn btn-outline-dark"><i class="far fa-edit"></i></a>
                    <a class="btn btn-outline-danger" href="<?= base_url('/viewmenuitems/delete' . esc($menu_id) . '/' . esc($current_category));?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>
            </div>
            <?php foreach($menu_items as $menu_item): ?>
                <?php if($menu_item['category'] ==  $current_category): ?>
                    <div class="card-body">
                        <!-- Menu Item Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title"><?= esc($menu_item['name']) ?></h5>
                                    <!-- Edit and Delete Menu Item Buttons -->
                                    <div>
                                        <a href="<?= base_url('viewmenuitems/addedit/' . esc($menu_id) . '/' . esc($menu_item['menu_item_id']));?>" class="btn btn-outline-dark"><i class="far fa-edit"></i></a>
                                        <a href="<?= base_url('viewmenuitems/itemdelete/' . esc($menu_item['menu_item_id']));?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                                <!-- Menu Item Description and Price -->
                                <div class="mb-3">
                                    <div class="mb-3 mt-2">
                                        <?= esc($menu_item['description']) ?>
                                    </div>
                                    <div class="">
                                        <?= esc($menu_item['price']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<!-- Add New Menu Item Button -->
<div class="container text-center mb-3">
    <a href="<?= base_url('viewmenuitems/addedit/' . esc($menu_id));?>" class="btn btn-dark btn-lg"><i class="bi bi-plus-circle"></i>&nbsp;Add Menu Item</a>
</div>
<br><br><br>

<?= $this->endSection() ?>
