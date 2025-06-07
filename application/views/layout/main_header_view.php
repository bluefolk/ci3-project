<!-- Main Content Header -->
<div class="row header align-items-center py-3 px-4">
    <div class="col">
        <h2 class="mb-0">SI PANDHU</h2>
    </div>
    <div class="col text-end d-flex justify-content-end align-items-center gap-2">
        <p class="mb-0 me-2">
            Halo, <?= $akun->nama_lengkap ?: $akun->username; ?> 👋
        </p>
        <?php if (!empty($this->session->userdata('foto'))): ?>

            <img src="<?= base_url('uploads/dokumen/' . $this->session->userdata('foto')); ?>" alt="Foto Profil"
                style="width: 35px; height: 35px; border-radius: 100%;">

        <?php else: ?>
            <!-- FA Icon User sebagai default -->
            <i class="bi bi-person-circle fs-2"></i>

        <?php endif; ?>

    </div>
</div>