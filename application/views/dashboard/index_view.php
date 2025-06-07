<div class="row">
    <div class="col-md-6 px-5 py-2">
        <a href="<?= site_url('dana_desa?jenis_pengajuan=dd_earmark_60') ?>" style="text-decoration: none;">
            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_dd_earmark_60 ?></h1>
                    <p class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        DD EARMARK 60</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 px-5 py-2">
        <a href="<?= site_url('dana_desa?jenis_pengajuan=alokasi_dana_desa') ?>" style="text-decoration: none;">
            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_add ?></h1>
                    <p class="card-text" class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        ALOKASI DANA DESA</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 px-5 py-3">
        <a href="<?= site_url('dana_desa?jenis_pengajuan=dana_lain') ?>" style="text-decoration: none;">

            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_dana_lain ?></h1>
                    <p class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        DANA LAIN</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 px-5 py-3">
        <a href="<?= site_url('dana_desa?jenis_pengajuan=dd_non_earmark_40') ?>" style="text-decoration: none;">

            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_dd_non_earmark_40 ?></h1>
                    <p class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        DD NON EARMARK 40</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 px-5 py-3">
        <a href="<?= site_url('dana_desa?jenis_pengajuan=ketahanan_pangan_tpk') ?>" style="text-decoration: none;">

            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_ketahanan_pangan_tpk ?></h1>
                    <p class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        KETAHANAN PANGAN TPK</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 px-5 py-3">
        <a href="<?= site_url('dana_desa?jenis_pengajuan=ketahanan_pangan_bumdesa') ?>" style="text-decoration: none;">

            <div class="card text-center mb-3" style="background-color: #8a92d3; color: white;">
                <div class="card-body">
                    <h1 class="card-title"><?= $total->total_ketahanan_pangan_bumdesa ?></h1>
                    <p class="card-text"
                        style="border: 1px solid white; padding: 20px; margin: 30px 5px 10px 10px; width: calc(100% - 20px); box-sizing: border-box;">
                        KETAHANAN PANGAN BUMDESA</p>
                </div>
            </div>
        </a>
    </div>
</div>