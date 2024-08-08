<?= $this->extend('template') ?>
<?= $this->section('content') ?>
    <div class="container-fluid d-flex justify-content-center align-items-center p-0" style="background-color: #E7DFD8; height: 100vh;">
        <div class="d-flex flex-column align-items-center">
            <h1 class="text-center mb-5" style="font-family: Marker Felt, fantasy; font-size: 50px;">Welcome to MenuScanOrder</h1>

            <div class="container">
                <div id="carousel_slides" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" style="max-width: 900px;">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel_slides" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carousel_slides" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carousel_slides" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url('images/cafe.png'); ?>" class="d-block w-100 h-100" alt="carousel_item1">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Effortlessly manage menu, orders, and inventory.</h5>
                                <p>Join Us Now</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('images/restaurant.png'); ?>" class="d-block w-100 h-100" alt="carousel_item2">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Receive real-time updates for new orders.</h5>
                                <p>Join Us Now</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('images/coffee_shop.png'); ?>" class="d-block w-100 h-100" alt="carousel_item3">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Customize your menu and offerings to attract more customers.</h5>
                                <p>Join Us Now</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel_slides" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel_slides" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="container text-center mb-5">
                <h2 class="mt-5" style="font-family: Marker Felt, fantasy;">Get Started Today!</h2>
                <p>Join MenuScanOrder now and revolutionize the way you manage your business!</p>
                <!-- <a href="#" class="btn btn-dark btn-lg">Login</a> -->
        </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
