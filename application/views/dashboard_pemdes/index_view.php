<div class="row">
    <div class="col-md-6 px-5 py-2">
        <a href="<?= site_url('dana_desa') ?>" style="text-decoration: none;">
            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_pengajuan ?></h1>
                    <p class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        PENGAJUAN</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 px-5 py-2">
        <a href="<?= site_url('dana_desa?status=verifikasi') ?>" style="text-decoration: none;">
            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_verifikasi ?></h1>
                    <p class="card-text" class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        DIVERIFIKASI</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 px-5 py-3">
        <a href="<?= site_url('dana_desa?status=ditolak') ?>" style="text-decoration: none;">

            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_rejected ?></h1>
                    <p class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        DITOLAK</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 px-5 py-3">
        <a href="<?= site_url('dana_desa?status=diterima') ?>" style="text-decoration: none;">

            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_approved ?></h1>
                    <p class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        DITERIMA</p>
                </div>
            </div>
        </a>
    </div>
</div>