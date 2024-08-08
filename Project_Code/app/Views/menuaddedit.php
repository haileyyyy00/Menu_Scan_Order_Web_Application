<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<!-- Menu Editor/Composer Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Image and Heading for Menu Editor or Composer -->
                <div class="container text-center">
                    <img src="<?= base_url('images/menuedit.jpeg'); ?>" width="300" height="300" alt="menuedit">
                </div>
                <h2 class="text-center mb-4"><?= isset($menu) ? 'Menu Editor' : 'Menu Composer' ?></h2>
                <!-- Form for adding or editing a menu -->
                <form method="post" action="<?= base_url('viewmenu/menuaddedit/' . esc($user_id, 'url') . (isset($menu) ? '/' . esc($menu['menu_id'], 'url') : '')) ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= isset($menu) ? esc($menu['name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <input type="text" class="form-control" id="remarks" name="remarks" value="<?= isset($menu) ? esc($menu['remarks']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="created_on" class="form-label">Created On</label>
                        <input type="date" class="form-control" id="created_on" name="created_on" value="<?= isset($menu) ? esc($menu['created_on']) : '' ?>">
                    </div>
                    <div>
                        <!-- Hidden field for user ID -->
                        <input type="hidden" id="user_id" name="user_id" value="<?= esc($user_id)?>">
                    </div>
                    <div class="text-center">
                        <!-- Submit button text conditional on whether the menu is being added or updated -->
                        <button type="submit" class="btn btn-outline-dark btn-lg mt-3"><?= isset($menu) ? 'Update Menu' : 'Add Menu' ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br><br><br>
</section>

<?= $this->endSection() ?>
