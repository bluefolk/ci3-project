<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>HISTORY</h1>
    <div class="input-group w-auto">
        <input type="text" class="form-control form-control-sm" placeholder="Cari ..." aria-label="Search"
            aria-describedby="search-addon">
        <button class="btn btn-outline-secondary btn-sm" type="button" id="search-addon"><i
                class="fas fa-search"></i></button>
    </div>
</div>

<table class="table table-borderless">
    <thead>
        <tr>
            <th>Tgl. Pengajuan</th>
            <th>Nama Desa</th>
            <th>Jenis Pembayaran</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($pengajuan)): ?>
            <tr>
                <td colspan="6" class="text-center py-4">
                    <div class="text-muted">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p class="mb-0">Data tidak ditemukan</p>
                    </div>
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($pengajuan as $p): ?>
                <tr>
                    <!-- <?php var_dump($pengajuan); ?> -->
                    <td><?php echo isset($p->created_at) ? date('d M Y', strtotime($p->created_at)) : ''; ?></td>
                    <td><?php echo $p->nama_desa; ?></td>
                    <td><?php echo $p->nama_kecamatan; ?></td>
                    <!-- <td>Rp <?php echo number_format($p->jumlah_bantuan, 0, ',', '.'); ?></td> -->
                    <td>
                        <?php
                        $status_class = '';
                        switch (isset($p->status) ? $p->status : '') {
                            case 'diajukan':
                                $status_class = 'warning';
                                break;
                            case 'diterima':
                                $status_class = 'success';
                                break;
                            case 'ditolak':
                                $status_class = 'danger';
                                break;
                        }
                        ?>
                        <span class="badge bg-<?php echo $status_class; ?>">
                            <?php echo isset($p->status) ? ucfirst($p->status) : ''; ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?php echo base_url('history/view/' . $p->id - 1); ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>


                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>