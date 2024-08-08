<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Container for user image and form for editing or adding a user -->
                <div class="container text-center">
                    <!-- User image with base URL function -->
                    <img src="<?= base_url('images/user.jpeg'); ?>" width="300" height="300" alt="user">
                </div>
                <!-- Heading changes based on whether it's editing or adding a user -->
                <h2 class="text-center mb-4"><?= isset($user) ? 'Edit User' : 'Add User' ?></h2>
                <!-- Form submits to add or edit endpoint depending on user existence -->
                <form method="post" action="<?= base_url('admin/addedit' . (isset($user) ? '/' . esc($user['user_id'], 'url') : '')) ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <!-- Escape output to prevent XSS -->
                        <input type="text" class="form-control" id="name" name="name" value="<?= isset($user) ? esc($user['name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <!-- Escape output to prevent XSS -->
                        <input type="email" class="form-control" id="email" name="email" value="<?= isset($user) ? esc($user['email']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <!-- Conditionally render selected attribute based on user's role -->
                            <option value="non-admin" <?= isset($user) && !$user['isAdmin'] ? 'selected' : '' ?>>user</option>
                            <option value="admin" <?= isset($user) && $user['isAdmin'] ? 'selected' : '' ?>>admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_status" class="form-label">Status</label>
                        <select class="form-control" id="user_status" name="user_status" required>
                            <!-- Conditionally render selected attribute based on user's status -->
                            <option value="active" <?= isset($user) && $user['status'] ? 'selected' : '' ?>>active</option>
                            <option value="inactive" <?= isset($user) && !$user['status'] ? 'selected' : '' ?>>inactive</option>
                        </select>
                    </div>
                    <div class="container text-center mt-5">
                        <!-- Button text changes based on whether it's editing or adding a user -->
                        <button type="submit" class="btn btn-lg btn-dark"><?= isset($user) ? 'Update User' : 'Add User' ?></button>
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
