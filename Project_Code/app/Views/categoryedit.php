<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<!-- Category Editor Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Image for Category Editor -->
                <div class="container text-center">
                    <img src="<?= base_url('images/categoryeditor.jpeg'); ?>" width="380" height="300" alt="menuedit">
                </div>
                <!-- Category Editor Form Heading -->
                <h2 class="text-center mb-4">Category Editor</h2>
                <!-- Form for editing the category -->
                <form method="post" action="<?= base_url('viewmenuitems/editcategory/' . esc($menu_id, 'url') . '/' . esc($category, 'url')) ?>">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <!-- Input for category name with XSS prevention -->
                        <input type="text" class="form-control" id="category" name="category" value="<?= esc($category) ?>" required>
                    </div>
                    <div>
                        <!-- Hidden input for menu ID to prevent manipulation -->
                        <input type="hidden" id="menu_id" name="menu_id" value="<?= esc($menu_id)?>">
                    </div>
                    <div class="text-center">
                        <!-- Submit button for updating the category -->
                        <button type="submit" class="btn btn-outline-dark btn-lg mt-3">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
