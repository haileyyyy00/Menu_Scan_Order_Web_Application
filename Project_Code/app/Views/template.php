<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuScanOrder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    @media print {
        #logo, #footer {
            display: none; /* Hides the logo and footer when printing */
        }
    }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #31352E;">
            <a class="navbar-brand">
                <img src="<?= base_url('images/menuScanOrder_logo.png'); ?>" width="300" height="100" alt="MenuScanOrder Logo" class="img-fluid rounded shadow" id="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= service('router')->getMatchedRoute()[0] == '/' ? 'active' : ''; ?>" href="<?= base_url(); ?>">Home</a>
                    </li>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('isAdmin')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'admin' ? 'active' : ''; ?>" href="<?= base_url("admin"); ?>">Admin Panel</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <?php $user_id = esc(session()->get('userId')) ?>
                                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'qrcode' ? 'active' : ''; ?>" href="<?= base_url("qrcode/" . $user_id); ?>">QRCode</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'viewmenu' ? 'active' : ''; ?>" href="<?= base_url("viewmenu/" . $user_id); ?>">Manage Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'track_order' ? 'active' : ''; ?>" href="<?= base_url("orders/track_order/" . $user_id); ?>">Track Order</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("logout"); ?>">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?= service('router')->getMatchedRoute()[0] == 'login' ? 'active' : ''; ?>" href="<?= base_url("login"); ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main content section -->
    <main>
        <?= $this->renderSection('content') ?> 
    </main>

    <!-- Footer -->
    <footer class="text-light py-3 fixed-bottom" style="background-color: #31352E;" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                   <p>&copy; <?= date('Y') ?> MenuScanOrder. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                   <a href="#" class="text-light me-3">Privacy Policy</a>
                   <a href="#" class="text-light">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
