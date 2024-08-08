<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <!-- Loop through order details and display each in a card -->
    <?php foreach($order_details as $order_detail): ?>
    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <!-- Row with two columns for displaying item name and quantity -->
            <div class="row">
                <div class="col-md-6">
                    <!-- Display item name with escaping to prevent XSS -->
                    <h2><?= esc($order_detail['name']) ?></h2>
                </div>
                <div class="col-md-6 text-end">
                    <!-- Display item quantity with escaping to prevent XSS, text aligned to right -->
                    <h3>Quantity: <?= esc($order_detail['quantity']) ?></h3>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light d-flex justify-content-center align-items-center">
            <!-- Checkbox for selection, centered both horizontally and vertically -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    <!-- Label is intentionally left blank for styling -->
                </label>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="container text-center">
        <!-- Close button to navigate back to order tracking -->
        <a class="btn btn-lg btn-dark me-2" href="<?= base_url('orders/track_order/' . esc($user_id)); ?>">Close</a>
    </div>
</div>

<?= $this->endSection() ?>
