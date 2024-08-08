<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuScanOrder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #F9F1F0; /* Light pink background for better readability */
        }
    </style>
</head>
<body>
<div class="container text-center mt-5">
    <div class="card text-white bg-dark mb-3" style="width: 100%;">
        <h1>Menu</h1>
    </div>
</div>

<!-- Form for ordering menu items, using POST method for security -->
<form method="POST" action="<?= base_url('order_handling/' . esc($user_id, 'url') . '/' . esc($table_number, 'url')) ?>">
    <?php foreach($categories as $category): ?>
        <?php $current_category = $category['category'] ?>
        <div class="container mt-5 mb-3">
            <div class="card shadow-lg">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="card-title mb-0"><?= esc($current_category) ?></h2>
                </div>
                <?php foreach($menu_items as $menu_item): ?>
                    <?php if($menu_item['category'] == $current_category): ?>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title"><?= esc($menu_item['name']) ?></h5>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <?= esc($menu_item['description']) ?>
                                    </div>
                                    <div>
                                        $<?= esc($menu_item['price']) ?>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <!-- Hidden input for menu item ID, used for order processing -->
                                        <input type="hidden" name="menu_item_ids[]" value="<?= esc($menu_item['menu_item_id']) ?>" />
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" id="quantity" name="quantities[]" value="0" min="0" class="form-control" style="width: auto; display: inline-block;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="text-center mb-4">
        <button type="submit" class="btn btn-dark btn-lg">Place Order</button>
    </div>
</form>
</body>
</html>
