<?php $this->load->view('layout/header_view'); ?>
<?php $this->load->view('layout/sidebar_view'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>INFORMASI AKUN</h2>
    </div>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="profile-container mt-4">
        <!-- Bagian kiri: Foto user -->
        <div class="profile-photo">
            <?php if (!empty($akun->foto)): ?>
                <img src="<?= base_url('uploads/dokumen/' . $akun->foto); ?>" alt="Foto Profil" class="img-thumbnail mb-2"
                    style="width: 200px; height: 220px; border-radius: 10%;">
            <?php else: ?>
                <!-- FA Icon User sebagai default -->
                <div class="d-flex justify-content-center align-items-center bg-light mb-2"
                    style="width: 200px; height: 220px; border-radius: 10%; border: 1px solid #ccc;">
                    <i class="fa fa-user fa-5x text-muted"></i>
                </div>

            <?php endif; ?>
            <div class="form-group mt-3">
                <!-- Form Upload Otomatis -->
                <?php echo form_open_multipart('informasi_akun/upload_foto/' . $akun->id, ['id' => 'formUploadFoto']); ?>
                <input type="file" name="foto" id="foto" class="form-control-file" accept="image/*" required>
                <?php echo form_close(); ?>
            </div>
        </div>

        <!-- Bagian kanan: Informasi user -->
        <div class="profile-info">
            <div class="info-item">
                <span class="info-label">Username</span>
                <span class="info-separator">:</span>
                <span class="info-value"><?php echo $akun->username; ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Nama Lengkap</span>
                <span class="info-separator">:</span>
                <span class="info-value"><?php echo $akun->nama_lengkap; ?></span>

            </div>
            <div class="info-item">
                <span class="info-label">Role</span>
                <span class="info-separator">:</span>
                <span class="info-value">

                    <?php
                    $status_class = '';
                    switch ($akun->role) {
                        case 'super_admin':
                            $status_class = 'dark';
                            break;
                        case 'admin_desa':
                            $status_class = 'success';
                            break;
                        case 'kabid':
                            $status_class = 'info';
                            break;
                        case 'kadis':
                            $status_class = 'primary';
                            break;
                    }
                    ?>
                    <span class="badge bg-<?php echo $status_class; ?>">
                        <?php echo strtoupper(str_replace('_', ' ', $akun->role)); ?>
                    </span>
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Email</span>
                <span class="info-separator">:</span>
                <span class="info-value"><?php echo $akun->email; ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Nomor Handphone</span>
                <span class="info-separator">:</span>
                <span class="info-value"><?php echo $akun->no_hp; ?></span>
            </div>
            <?php if (!empty($akun->nama_desa)): ?>
                <div class="info-item">
                    <span class="info-label">Nama Desa</span>
                    <span class="info-separator">:</span>
                    <span class="info-value"><?php echo $akun->nama_desa; ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($akun->nama_kecamatan)): ?>
                <div class="info-item">
                    <span class="info-label">Nama Kecamatan</span>
                    <span class="info-separator">:</span>
                    <span class="info-value"><?php echo $akun->nama_kecamatan; ?></span>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="ubah-profil-container">
        <a href="<?= base_url('informasi_akun/edit/' . $akun->id); ?>" class="btn custom-btn-block custom-btn-lg">
            <i class="fas fa-edit"></i> UBAH PROFIL
        </a>
    </div>
</div>
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

    .profile-container {
        display: flex;
        gap: 8rem;
        align-items: flex-start;
        margin-left: 4rem;
        margin-bottom: 2rem;

    }

    .profile-photo img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #dee2e6;
    }

    .profile-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .info-label {
        width: 150px;
        font-weight: 500;
    }

    .info-separator {
        color: #6c757d;
    }

    .info-value {
        flex: 1;
        margin-left: 2rem;

    }

    .custom-btn-lg {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        font-weight: 500;
    }

    .custom-btn-block:hover {
        color: white;

        background-color: rgb(129, 134, 29);
    }

    .ubah-profil-container {
        margin-top: 4.5rem;
        /* margin-bottom: 2rem; */
    }

    .custom-btn-block {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        font-weight: 500;
        background-color: #b0b28a;
        /* Biru Bootstrap */
        color: white;
        border: none;
        border-radius: 6px;
        display: block;
        text-align: center;
    }
</style>

<?php $this->load->view('layout/footer_view'); ?>
<script>
    document.getElementById('foto').addEventListener('change', function () {
        if (this.files.length > 0) {
            document.getElementById('formUploadFoto').submit();
        }
    });

</script>