<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<!-- Menu Item Editor/Composer Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Image for Menu Item Editor/Composer -->
                <div class="container text-center">
                    <img src="<?= base_url('images/menuedit.jpeg'); ?>" width="300" height="300" alt="menuedit">
                </div> 
                <!-- Conditional Heading for Editor or Composer -->
                <h2 class="text-center mb-4"><?= isset($menu) ? 'Menu Item Editor' : 'Menu Item Composer' ?></h2>
                <!-- Form for adding or editing a menu item -->
                <form method="post" action="<?= base_url('viewmenuitems/addedit/' . esc($menu_id, 'url') . (isset($menu_item) ? '/' . esc($menu_item['menu_item_id'], 'url') : '')) ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= isset($menu_item) ? esc($menu_item['name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" value="<?= isset($menu_item) ? esc($menu_item['category']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?= isset($menu_item) ? esc($menu_item['description']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= isset($menu_item) ? esc($menu_item['price']) : '' ?>" required>
                    </div>
                    <div>
                        <!-- Hidden field for storing menu ID -->
                        <input type="hidden" id="menu_id" name="menu_id" value="<?= esc($menu_id)?>">
                    </div>
                    <div class="text-center">
                        <!-- Submit button text conditional on whether item is being added or updated -->
                        <button type="submit" class="btn btn-outline-dark btn-lg mt-3"><?= isset($menu_item) ? 'Update Menu Item' : 'Add Menu Item' ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
</section>

<?= $this->endSection() ?>
