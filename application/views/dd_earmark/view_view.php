<?php $this->load->view('layout/header_view'); ?>
<?php $this->load->view('layout/sidebar_view'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>DETAIL DD EARMARK</h1>
    <a href="<?php echo base_url('dd_earmark'); ?>" class="btn btn-light btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="details-grid">
    <div class="detail-item">
        <span class="detail-label">Nama Desa</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $pengajuan->nama_desa; ?></span>
    </div>
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
        <span class="detail-label">Status</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <?php
            $status_class = '';
            switch($pengajuan->status) {
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

<div class="file-list mt-4">
    <?php
    $jenis_dokumen_dd_earmark = [
        'surat_permohonan_bupati_cq_dpmd' => 'Surat Permohonan Ke Bupati Cq, Kepala DPMD',
        'rekomendasi_camat' => 'Rekomendasi Camat',
        'surat_permohonan_bank' => 'Surat Permohonan ke BANK',
        'spp1_spp2_sptb' => 'SPP 1, SPP 2 & SPTB',
        'rencana_penggunaan_dana_rpd' => 'Rencana Penggunaan Dana (RPD)',
        'berita_acara_verifikasi_rkpdes_apbdes_2025' => 'Berita Acara Hasil Verivikasi RKPdes dan APBDes Tahun 2025',
        'kertas_kerja_pemeriksaan_lpj_tahap_ii_2024' => 'Kertas Kerja hasil pemeriksaan LPJ Tahap II 2024',
        'foto_baliho_realisasi_apbdes_2024' => 'Foto Baliho Realisasi APBdes Tahun 2024',
        'foto_baliho_apbdes_2025' => 'Foto Baliho APBdes Tahun 2025',
        'rekening_koran_fc_buku_rekening' => 'Rekening Koran/FC Buku Rekening',
        'lpj_tahap_ii_2024' => 'LPJ Tahap II Tahun 2024'
    ];
    ?>
    <?php foreach($jenis_dokumen_dd_earmark as $jenis => $label): ?>
    <?php 
        $current_file = null;
        foreach($dokumen as $d) {
            if($d->jenis_dokumen == $jenis) {
                $current_file = $d;
                break;
            }
        }
    ?>
    <div class="file-item">
        <span class="file-label"><?php echo $label; ?></span>
        <span class="file-separator">:</span>
        <?php if($current_file): ?>
        <a href="<?php echo base_url('uploads/dokumen_dd_earmark/'.$current_file->nama_file); ?>" class="btn btn-light btn-sm" target="_blank">
            <i class="fas fa-eye"></i> Lihat File
        </a>
        <?php else: ?>
        <span class="text-muted">Tidak ada file</span>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>

<?php if(in_array($this->session->userdata('role'), ['kadis', 'kabid']) && $pengajuan->status == 'diajukan'): ?>
<div class="button-group mt-4">
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
        <i class="fas fa-times"></i> Tolak
    </button>
    <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#approveModal">
        <i class="fas fa-check"></i> Terima
    </button>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Tolak Pengajuan DD Earmark</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('dd_earmark/update_status/'.$pengajuan->id); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="status" value="ditolak">
                    <div class="mb-3">
                        <label for="catatan_reject" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan_reject" name="catatan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Terima Pengajuan DD Earmark</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('dd_earmark/update_status/'.$pengajuan->id); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="status" value="diterima">
                    <div class="mb-3">
                        <label for="catatan_approve" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan_approve" name="catatan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

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