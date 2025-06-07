<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>
<div class="d-flex justify-content-between align-items-center mb-3">

    <h2><?php echo $bap->nama_desa; ?></h2>
    <a href="<?php echo base_url('berita_acara'); ?>" class="btn btn-light btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
                'catatan' => null,
</div>

<div class="details-grid">
    <div class="detail-item">
        <span class="detail-label">Nomor Pengajuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->no_pengajuan; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Tanggal Pengajuan</span>
        <span class="detail-separator">:</span>

        <span class="detail-value"><?php echo date('d M Y', strtotime($bap->tanggal_pengajuan)); ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nomor Berita Acara</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->no_bap; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama Desa</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->nama_desa; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Kecamatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->nama_kecamatan; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->nama_kepala_desa; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Kontak</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->no_kontak_kades; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama BANK</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->nama_bank; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Rekening</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->no_rekening; ?></span>
    </div>

    <div class="detail-item">
        <span class="detail-label">Status</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <?php
            $status_class = '';
            switch ($bap->status) {
                case 'diajukan':
                    $status_class = 'warning';
                    break;
                case 'diterima':
                    $status_class = 'success';
                    break;
                // case 'verifikasi':
                //     $status_class = 'info';
                //     break;
                // case 'verifikasi_ditolak':
                //     $status_class = 'danger';
                //     break;
                // case 'disposisi':
                //     $status_class = 'primary';
                //     break;
                // case 'berita_acara_siap':
                //     $status_class = 'primary';
                //     break;
                // case 'disposisi_ditolak':
                //     $status_class = 'danger';
                //     break;
                case 'ditolak':
                    $status_class = 'danger';
                    break;
            }
            ?>
            <span class="badge bg-<?php echo $status_class; ?>">
                <?php echo strtoupper(str_replace('_', ' ', $bap->status)); ?>
            </span>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jumlah Bantuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">Rp <?php echo number_format($bap->jumlah_bantuan, 0, ',', '.'); ?></span>
    </div>

    <div class="detail-item">
        <span class="detail-label">Catatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->catatan; ?></span>
    </div>

    <div class="detail-item">
        <span class="detail-label">Jenis Pengajuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <span class="badge bg-primary">
                <?php echo strtoupper(str_replace('_', ' ', $bap->jenis_pengajuan)); ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Terakhir Diperbarui</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <span class="badge bg-dark blink-badge">
                <span
                    class="detail-value"><?php echo date('d M Y H:i', strtotime($bap->tanggal_verifikasi)) . ' WIT.'; ?></span>
            </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jenis Bantuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $bap->jenis_bantuan; ?></span>
    </div>


</div>
<h5 style="margin-top: 40px;">DOKUMEN</h5>

<div class="file-list mt-4">
    <?php foreach ($dokumen as $k => $d): ?>
        <div class="file-item">
            <span class="file-label"><?php echo ucwords(str_replace('_', ' ', $jenis_dokumen[$k])); ?></span>
            <span class="file-separator">:</span>
            <a href="<?php echo base_url('uploads/dokumen/' . $d->nama_file); ?>" class="btn btn-light btn-sm"
                target="_blank">
                <i class="fas fa-eye"></i> Lihat File
            </a>
        </div>
    <?php endforeach; ?>
</div>
<?php if (in_array($this->session->userdata('role'), ['kadis']) && $bap->status == 'diajukan'): ?>
    <div class="button-group mt-5  d-flex justify-content-center">
        <button type="button" class="btn btn-danger me-4" data-bs-toggle="modal" data-bs-target="#rejectModal">
            <i class="fas fa-times"></i> Tolak Berita Acara
        </button>
        <button type="button" class="btn btn-success ms-4" data-bs-toggle="modal" data-bs-target="#approveModal">
            <i class="fas fa-check"></i> Terima Berita Acara
        </button>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Tolak Berita acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('berita_acara/update_status/' . $bap->id); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="status" value="ditolak">
                        <input type="hidden" name="no_kontak_kades" id="no_kontak_kades"
                            value="<?php echo $bap->no_kontak_kades; ?>">
                        <input type="hidden" name="no_bap" id="no_bap"
                            value="<?php echo $bap->no_bap; ?>">
                        <input type="hidden" name="verifikator_id"
                            value="<?php echo $this->session->userdata('user_id'); ?>">
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
                    <h5 class="modal-title" id="approveModalLabel">Terima Berita Acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('berita_acara/update_status/' . $bap->id); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="status" value="diterima">
                        <input type="hidden" name="no_kontak_kades" id="no_kontak_kades"
                            value="<?php echo $bap->no_kontak_kades; ?>">
                        <input type="hidden" name="no_bap" id="no_bap"
                            value="<?php echo $bap->no_bap; ?>">
                        <input type="hidden" name="verifikator_id"
                            value="<?php echo $this->session->userdata('user_id'); ?>">
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
        grid-template-columns: 600px 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .detail-item {
        display: grid;
        grid-template-columns: 250px auto 1fr;
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

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .blink-badge {
        animation: blink 2s linear infinite;
    }
</style>

<?php $this->load->view('layout/footer_view'); ?>