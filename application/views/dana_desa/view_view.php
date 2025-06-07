<?php $this->load->view('layout/header_view'); ?>
<?php $this->load->view('layout/sidebar_view'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>DETAIL PENGAJUAN</h2>
    <a href="<?php echo base_url('dana_desa'); ?>" class="btn btn-light btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="details-grid">
    <div class="detail-item">
        <span class="detail-label">Nomor Pengajuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo $pengajuan->no_pengajuan; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Tanggal Pengajuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"><?php echo date('d M Y', strtotime($pengajuan->tanggal_pengajuan)); ?></span>
    </div>
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
            switch ($pengajuan->status) {
                case 'diajukan':
                    $status_class = 'warning';
                    break;
                case 'diterima':
                    $status_class = 'success';
                    break;
                case 'verifikasi':
                    $status_class = 'info';
                    break;
                case 'verifikasi_ditolak':
                    $status_class = 'danger';
                    break;
                case 'disposisi':
                    $status_class = 'primary';
                    break;
                case 'berita_acara_siap':
                    $status_class = 'primary';
                    break;
                case 'disposisi_ditolak':
                    $status_class = 'danger';
                    break;
                case 'ditolak':
                    $status_class = 'danger';
                    break;
            }
            ?>
            <span class="badge bg-<?php echo $status_class; ?>">
                <?php echo strtoupper(str_replace('_', ' ', $pengajuan->status)); ?>
            </span>
        </span>
    </div>

    <div class="detail-item">
        <span class="detail-label">Jenis Pengajuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <span class="badge bg-info">
                <?php echo strtoupper(str_replace('_', ' ', $pengajuan->jenis_pengajuan)); ?></span>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Terakhir Diperbarui</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <span class="badge bg-dark blink-badge">
                <span
                    class="detail-value"><?php echo date('d M Y H:i', strtotime($pengajuan->tanggal_verifikasi)) . ' WIT.'; ?></span>
            </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jenis Bantuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"> <?php echo $pengajuan->jenis_bantuan; ?></span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Catatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value"> <?php echo $pengajuan->catatan; ?></span>
    </div>
</div>
<h5 style="margin-top: 40px;">DOKUMEN PENGAJUAN</h5>

<div class="file-list mt-2">
    <?php foreach ($bap_dokumen as $k => $d): ?>
        <div class="file-item">
            <span class="file-label">Dokumen Berita Acara</span>
            <span class="file-separator">:</span>
            <a href="<?php echo base_url('uploads/dokumen/' . $d->nama_file); ?>" class="btn btn-light btn-sm"
                target="_blank">
                <i class="fas fa-eye"></i> Lihat File
            </a>
        </div>
    <?php endforeach; ?>
</div>
<div class="file-list mt-3">
    <?php foreach ($dokumen as $k => $d): ?>
        <div class="file-item">
            <span class="file-label"><?php echo strtoupper(str_replace('_', ' ', $jenis_dokumen[$k])); ?></span>
            <span class="file-separator">:</span>
            <a href="<?php echo base_url('uploads/dokumen/' . $d->nama_file); ?>" class="btn btn-light btn-sm"
                target="_blank">
                <i class="fas fa-eye"></i> Lihat File
            </a>
        </div>
    <?php endforeach; ?>
</div>
<?php if (in_array($this->session->userdata('role'), ['kadis']) && $pengajuan->status == 'berita_acara_siap'): ?>
    <div class="button-group mt-4  d-flex justify-content-center">
        <button type="button" class="btn btn-danger me-4" data-bs-toggle="modal" data-bs-target="#rejectModal">
            <i class="fas fa-times"></i> Tolak Pengajuan
        </button>
        <button type="button" class="btn btn-success ms-4" data-bs-toggle="modal" data-bs-target="#approveModal">
            <i class="fas fa-check"></i> Terima Pengajuan
        </button>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Tolak Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('dana_desa/update_status/' . $pengajuan->id); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="status" value="ditolak">
                        <input type="hidden" name="no_kontak_kades" id="no_kontak_kades"
                            value="<?php echo $pengajuan->no_kontak_kades; ?>">
                        <input type="hidden" name="no_pengajuan" id="no_pengajuan"
                            value="<?php echo $pengajuan->no_pengajuan; ?>">
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
                    <h5 class="modal-title" id="approveModalLabel">Terima Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('dana_desa/update_status/' . $pengajuan->id); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="status" value="diterima">
                        <input type="hidden" name="no_kontak_kades" id="no_kontak_kades"
                            value="<?php echo $pengajuan->no_kontak_kades; ?>">
                        <input type="hidden" name="no_pengajuan" id="no_pengajuan"
                            value="<?php echo $pengajuan->no_pengajuan; ?>">
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
<?php elseif (in_array($this->session->userdata('role'), ['super_admin']) && $pengajuan->status == 'diajukan'): ?>
    <div class="button-group mt-5  d-flex justify-content-center">
        <button type="button" class="btn btn-danger ms-4" data-bs-toggle="modal" data-bs-target="#rejectModalVerifikasi">
            <i class="fas fa-check"></i>Tolak Verifikasi
        </button>
        <button type="button" class="btn btn-success ms-4" data-bs-toggle="modal" data-bs-target="#approveModalVerifikasi">
            <i class="fas fa-check"></i> Verifikasi
        </button>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModalVerifikasi" tabindex="-1" aria-labelledby="rejectModalVerifikasiLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalVerifikasiLabel">Tolak Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('dana_desa/update_status/' . $pengajuan->id); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="status" value="verifikasi_ditolak">
                        <input type="hidden" name="no_kontak_kades" id="no_kontak_kades"
                            value="<?php echo $pengajuan->no_kontak_kades; ?>">
                        <input type="hidden" name="no_pengajuan" id="no_pengajuan"
                            value="<?php echo $pengajuan->no_pengajuan; ?>">
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

    <!-- Approve Modal Verifikasi -->
    <div class="modal fade" id="approveModalVerifikasi" tabindex="-1" aria-labelledby="approveModalVerifikasiLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalVerifikasiLabel">Verifikasi Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('dana_desa/update_status/' . $pengajuan->id); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="status" value="verifikasi">
                        <input type="hidden" name="no_kontak_kades" id="no_kontak_kades"
                            value="<?php echo $pengajuan->no_kontak_kades; ?>">
                        <input type="hidden" name="no_pengajuan" id="no_pengajuan"
                            value="<?php echo $pengajuan->no_pengajuan; ?>">

                        <input type="hidden" name="verifikator_id"
                            value="<?php echo $this->session->userdata('user_id'); ?>">
                        <p>Apakah Anda yakin ingin memverifikasi pengajuan dana desa ini?</p>
                        <div class="mb-3">
                            <label for="catatan_approve" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan_approve" name="catatan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php elseif (in_array($this->session->userdata('role'), ['kabid']) && $pengajuan->status == 'verifikasi'): ?>
    <div class="button-group mt-4  d-flex justify-content-center">
        <button type="button" class="btn btn-danger me-4" data-bs-toggle="modal" data-bs-target="#rejectDisposisiModal">
            <i class="fas fa-times"></i> Tolak Disposisi
        </button>
        <button type="button" class="btn btn-success ms-4" data-bs-toggle="modal" data-bs-target="#disposisiModal">
            <i class="fas fa-check"></i> Disposisi
        </button>
    </div>


    <!-- Reject Disposisi Modal -->
    <div class="modal fade" id="rejectDisposisiModal" tabindex="-1" aria-labelledby="rejectDisposisiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectDisposisiModalLabel">Tolak Disposisi Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('dana_desa/update_status/' . $pengajuan->id); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="status" value="disposisi_ditolak">
                        <input type="hidden" name="verifikator_id"
                            value="<?php echo $this->session->userdata('user_id'); ?>">
                        <p>Apakah Anda yakin ingin menolak disposisi pengajuan dana desa ini?</p>
                        <div class="mb-3">
                            <label for="catatan_approve" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan_approve" name="catatan" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Disposisi</button>
                    </div>

                </form>
            </div>
        </div>
    </div>div>

    <!-- Disposisi Modal -->
    <div class="modal fade" id="disposisiModal" tabindex="-1" aria-labelledby="disposisiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disposisiModalLabel">Disposisi Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('dana_desa/update_status/' . $pengajuan->id); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="status" value="disposisi">
                        <input type="hidden" name="verifikator_id"
                            value="<?php echo $this->session->userdata('user_id'); ?>">
                        <p>Apakah Anda yakin ingin mendisposisi pengajuan dana desa ini?</p>
                        <div class="mb-3">
                            <label for="catatan_approve" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan_approve" name="catatan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Disposisi</button>
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
        grid-template-columns: 600px 20px 1fr;
        align-items: center;
        gap: 5.2rem;
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