<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<!-- Order Tracking Section Heading -->
<div class="container text-center mt-5">
    <h2 class="mt-3 mb-5">Order Tracking</h2>
</div> 

<!-- Filter Form for Orders -->
<div class="container-fluid mt-3">
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="post" action="<?= base_url('orders/track_order/' . esc($user_id)); ?>" id="order_filter">
                <div class="input-group">
                    <!-- Dropdown for selecting order filter: 'Today' or 'All' -->
                    <select class="form-select" name="order_filter">
                        <option value="all">All Orders</option>
                        <option value="today">Today's Orders</option>
                    </select>
                    <button class="btn btn-dark" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Table to Display Orders -->
<table class="table table-responsive" id="userManagementTable">
    <thead class="table-dark">
        <tr>
            <th>Order ID</th>
            <th>Table</th>
            <th>Created At</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr class='table-light'>
                <td><?= esc($order['order_id']) ?></td>
                <td><?= esc($order['table_number']) ?></td>
                <td><?= esc($order['created_at']) ?></td>
                <td>
                    <!-- Display status with button styling -->
                    <?php if($order['status'] == 'Pending'): ?>
                        <button type="button" class="btn btn-lg btn-danger">Pending</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-lg btn-success">Completed</button>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <!-- Actions with hidden input for passing additional data -->
                    <input type="hidden" class="user_id" value="<?= esc($order['user_id']) ?>">
                    <a class="btn btn-lg btn-dark" href="<?= base_url('orders/view_order/' . esc($user_id) . '/' . esc($order['table_number']) . '/' . esc($order['created_at'])); ?>"><i class="bi bi-eye"></i> View</a>
                    <a class="btn btn-lg btn-outline-dark" href="<?= base_url('orders/update_status/' . esc($user_id) . '/' . esc($order['order_id']) . '/' . esc($order['created_at'])); ?>">Update Status</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
