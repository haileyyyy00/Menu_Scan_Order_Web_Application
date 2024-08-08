<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<!-- User Management Header Section -->
<div class="container text-center mt-3">
    <img src="<?= base_url('images/users.png'); ?>" width="350" height="200" alt="user">
    <h2 class="mt-3 mb-5">User Management</h2>
</div> 

<!-- Search and Add User Section -->
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="get" action="<?= base_url('admin/'); ?>">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Who are your looking for?" name="search">
                    <button class="btn btn-dark" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-md-end mb-2">
            <a href="<?= base_url('admin/addedit');?>" class="btn btn-outline-dark btn-lg">
                <i class="fa-solid fa-circle-plus"></i> Add User
            </a>
        </div>
    </div>
</div>

<!-- User Management Table -->
<table class="table table-responsive" id="userManagementTable">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <?php if($user['archived'] == false): ?>
                <tr class='table-light'>
                    <td><?= esc($user['name']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td>
                        <!-- Display user status with appropriate styling -->
                        <?php if($user['status'] == true): ?>
                            <button type="button" class="btn btn-lg btn-success" disabled>Active</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-lg btn-secondary" disabled>Inactive</button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- Actions with security confirmation for archiving -->
                        <a class="btn btn-lg btn-dark me-2" href="<?= base_url('admin/addedit/' . esc($user['user_id'], 'url'));?>"><i class="bi bi-pencil-fill"></i></a>
                        <a class="btn btn-lg btn-danger me-2" href="<?= base_url('admin/archive/' . esc($user['user_id'], 'url'));?>" onclick="return confirm('Are you sure you want to archive this user?')"><i class="bi bi-archive"></i></a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Flash Messages for User Actions -->
<section class="py-2">
    <div class="container-fluid">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<br>
<br>
<br>
<br>

<?= $this->endSection() ?>
