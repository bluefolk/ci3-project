<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><?php echo $pengajuan->nama_desa; ?></h4>
</div>

<div class="details-grid">

    <div class="detail-item">
        <span class="detail-label">Kecamatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $pengajuan->nama_kecamatan; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $pengajuan->nama_kepala_desa; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Kontak</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $pengajuan->no_kontak_kades; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama BANK</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $pengajuan->nama_bank; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Rekening</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $pengajuan->no_rekening; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jumlah Bantuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">Rp <?php echo number_format($pengajuan->jumlah_bantuan, 0, ',', '.'); ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Catatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $pengajuan->catatan; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Status</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <?php
            $status_class = '';
            switch ($pengajuan->status) {
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
                <?php echo ucfirst($pengajuan->status); ?>
            </span>
        </span>
    </div>

</div>


<div class="file-item">
    <span class="file-label">Berita Acara</span>
    <span class="file-separator">:</span>
    <!-- <?php if ($current_file): ?>
        <a href="" class="btn btn-light btn-sm" target="_blank">
            <i class="fas fa-eye"></i> Lihat File
        </a> -->
        <!-- <?php else: ?> -->
        <span class="text-muted">Tidak ada file</span>
        <!-- <?php endif; ?> -->
</div>
</div>


<style>
    .details-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .detail-item {
        display: grid;
        grid-template-columns: 200px auto 1fr;
        align-items: center;
        gap: 1rem;
    }

    .detail-label {
        font-weight: 500;
    }

    .detail-separator {
        color: #6c757d;
    }

    .file-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .file-item {
        display: grid;
        grid-template-columns: 200px auto 1fr;
        align-items: center;
        gap: 1rem;
    }

    .file-label {
        font-weight: 500;
    }

    .file-separator {
        color: #6c757d;
    }

    .button-group {
        display: flex;
        gap: 0.5rem;
    }
</style>

<?php $this->load->view('layout/footer_view'); ?>