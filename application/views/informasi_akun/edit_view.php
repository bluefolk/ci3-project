<?php $this->load->view('layout/header_view'); ?>
<?php $this->load->view('layout/sidebar_view'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>EDIT INFORMASI AKUN</h2>
</div>
<?php echo form_open_multipart('informasi_akun/edit/' . $akun->id); ?>

<div class="details-grid lg:grid-cols-2">

    <div class="details-grid">
        <div class="detail-item">
            <span class="detail-label">Username</span>
            <span class="detail-separator">:</span>
            <span class="detail-value">
                <input type="text" name="username" id="username"
                    class="form-control form-control-sm <?php echo form_error('username') ? 'is-invalid' : ''; ?>"
                    value="<?php echo $akun->username; ?>" disabled required>
                <?php echo form_error('username', '<div class="invalid-feedback">', '</div>'); ?>

            </span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Nama Lengkap</span>
            <span class="detail-separator">:</span>
            <span class="detail-value">
                <input type="text" name="nama_lengkap" id="nama_lengkap"
                    class="form-control form-control-sm <?php echo form_error('nama_lengkap') ? 'is-invalid' : ''; ?>"
                    value="<?php echo $akun->nama_lengkap; ?>" required>
                <?php echo form_error('nama_lengkap', '<div class="invalid-feedback">', '</div>'); ?>

            </span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Role</span>
            <span class="detail-separator">:</span>
            <span class="detail-value">
                <input type="text" name="role" id="role"
                    class="form-control form-control-sm <?php echo form_error('role') ? 'is-invalid' : ''; ?>"
                    value="<?php echo strtoupper(str_replace('_', ' ', $akun->role)); ?>" disabled required>
                <?php echo form_error('role', '<div class="invalid-feedback">', '</div>'); ?>

            </span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Email</span>
            <span class="detail-separator">:</span>
            <span class="detail-value">
                <input type="text" name="email" id="email"
                    class="form-control form-control-sm <?php echo form_error('email') ? 'is-invalid' : ''; ?>"
                    value="<?php echo $akun->email; ?>" required>
                <?php echo form_error('email', '<div class="invalid-feedback">', '</div>'); ?>

            </span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Nomor Handphone</span>
            <span class="detail-separator">:</span>
            <span class="detail-value">
                <input type="text" name="no_hp" id="no_hp"
                    class="form-control form-control-sm <?php echo form_error('no_hp') ? 'is-invalid' : ''; ?>"
                    value="<?php echo $akun->no_hp; ?>" required>
                <?php echo form_error('no_hp', '<div class="invalid-feedback">', '</div>'); ?>

            </span>
        </div>
        <?php if (!empty($akun->nama_desa)): ?>
            <div class="detail-item">
                <span class="detail-label">Nama Desa</span>
                <span class="detail-separator">:</span>
                <span class="detail-value">
                    <input type="text" name="nama_desa" id="nama_desa"
                        class="form-control form-control-sm <?php echo form_error('nama_desa') ? 'is-invalid' : ''; ?>"
                        value="<?php echo $akun->nama_desa; ?>" disabled required>
                    <?php echo form_error('nama_desa', '<div class="invalid-feedback">', '</div>'); ?>
                </span>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($akun->nama_kecamatan)): ?>
            <div class="detail-item">
                <span class="detail-label">Nama Kecamatan</span>
                <span class="detail-separator">:</span>
                <span class="detail-value">
                    <input type="text" name="nama_kecamatan" id="nama_kecamatan"
                        class="form-control form-control-sm <?php echo form_error('nama_kecamatan') ? 'is-invalid' : ''; ?>"
                        value="<?php echo $akun->nama_kecamatan; ?>" disabled required>
                    <?php echo form_error('nama_kecamatan', '<div class="invalid-feedback">', '</div>'); ?>

                </span>
            </div>
        <?php endif; ?>

    </div>
</div>
<h5 style="">PENGATURAN AKUN</h5>
<div class="detail-item mt-3">
    <span class="detail-label">Ubah Password</span>
    <span class="detail-separator">:</span>
    <span class="detail-value">
        <div style="position: relative;">
            <input type="password" name="password" id="password" placeholder="******"
                class="form-control form-control-sm <?php echo form_error('password') ? 'is-invalid' : ''; ?>"
                style="padding-right: 35px;"> <!-- untuk beri ruang icon -->

            <i class="fa fa-eye toggle-password" toggle="#password"
                style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
        </div>
        <?php echo form_error('password', '<div class="invalid-feedback d-block mt-1">', '</div>'); ?>

    </span>
</div>

<div class="button-group d-flex justify-content-center">
    <a href="<?php echo base_url('informasi_akun'); ?>" class="btn btn-light btn-sm me-2">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <button id="submitBtn" type="submit" class="btn btn-primary btn-sm ms-4"
        style="background-color: #b0b28a; border-color: #b0b28a;">
        <i class="fas fa-save"></i> Simpan
    </button>
</div>
<?php echo form_close(); ?>

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
        grid-template-columns: 200px auto 1fr auto;
        align-items: center;
        gap: 1rem;
    }

    .file-label {
        font-weight: 500;
    }

    .file-separator {
        color: #6c757d;
    }

    .custom-file {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .custom-file-input {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .custom-file-label {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        cursor: pointer;
    }

    .custom-file-label.selected {
        color: #495057;
    }

    .button-group {
        display: flex;
        gap: 0.5rem;
    }

    .preview-btn {
        margin-left: 10px;
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }

    .preview-btn:hover {
        background-color: #138496;
        border-color: #117a8b;
        color: white;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>