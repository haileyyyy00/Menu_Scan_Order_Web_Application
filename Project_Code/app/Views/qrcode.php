<?= $this->extend('template') ?>
<?= $this->section('content') ?>

<style>
    @media print {
        #qrmenu_icon, #qrcodeheader, #table-number, #enterBtn, #printBtn {
            display: none; /* Hides specified elements during printing */
        }
        .card-container {
            page-break-after: always;
            break-after: page; /* Ensures each card is printed on a new page */
        }
        .table-print-break {
            page-break-after: always;
            break-after: page; /* Ensures there is a page break after the table */
        }
    }
</style>

<!-- QR Code Generator UI for non-printing views -->
<div class="container text-center print-hide">
    <img src="<?= base_url('images/qrmenu.jpeg'); ?>" width="400" height="290" alt="user" id='qrmenu_icon'>
    <h2 mt-3 id="qrcodeheader">QRCode Generator</h2>
</div>

<!-- Form for QR Code Generation -->
<div class="container justify-content-center mt-5 mb-3 print-hide" style="padding-left: 50px; padding-right: 50px">
    <form method="get" action="<?= base_url('qrcode/' . $user_id); ?>">
        <div class="input-group input-group-lg justify-content-center">
            <input type="number" class="form-control" id="table-number" placeholder="Please enter total number of tables" name="tableNumber" required min="1">
            <button class="btn btn-dark" type="submit" id="enterBtn">Enter</button>
        </div>
    </form>
</div>
<div class="d-grid gap-2 mb-10 print-hide">
    <button class="btn btn-dark" type="button" id="printBtn" onclick="window.print()">Print</button>
</div>

<!-- Table Displaying QR Code URLs -->
<div class="container mt-5 table-print-break">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Table</th>
                <th scope="col">QRCode URL</th>
            </tr>
        </thead>
        <tbody>
            <?php $tableNumber = 1; ?>
            <?php foreach ($urls as $url): ?>
                <tr>
                    <td><?=$tableNumber++?></td>
                    <td><?=esc($url)?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Cards with QR Codes for printing -->
<div class="container mt-5 print-show">
    <div class="row">
        <?php $tableNum = 1; ?>
        <?php foreach ($qr_codes as $qr_code): ?>
            <div class="col-md-4 mb-4 card-container">
                <div class="card mb-4 shadow-lg" style="width: 18rem;">
                    <img src="data:image/png;base64,<?= esc(base64_encode($qr_code)); ?>" alt="QR Code">
                    <div class="card-body">
                        <h5 class="card-title text-center">Table <?=$tableNum++;?></h5>
                        <h5 class="card-title text-center"><strong>SCAN ME</strong></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<br><br><br>

<?= $this->endSection() ?>
