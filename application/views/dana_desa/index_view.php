<?php $this->load->view('layout/header_view'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>PENGAJUAN DANA</h2>
    <div class="d-flex gap-3">

        <?php if (in_array($this->session->userdata('role'), ['admin_desa'])): ?>
            <button class="btn" style="background-color: #b0b28a;
                   border: none;
                   color: white;
                   padding: 6px 16px;
                   height: 34px;
                   line-height: 1;
                   font-size: 14px;
                   border-radius: 10px;" onclick="window.location.href='<?= base_url('dana_desa/create'); ?>'">
                <i class="fas fa-plus me-1"></i> Tambah
            </button>
        <?php endif; ?>

        <!-- Dropdown Filter Status -->
        <div class="dropdown">
            <a href="<?= base_url('dana_desa/export_excel'); ?>" class="btn me-2 btn-success btn-sm">
                <i class="fas fa-file-download"></i> Export
            </a>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterStatusDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-filter"></i> Status
            </button>

            <ul class="dropdown-menu" aria-labelledby="filterStatusDropdown">
                <?php $active = ($status_filter == 'semua') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="<?php echo base_url('dana_desa'); ?>">Semua</a>
                <?php $active = ($status_filter == 'diajukan') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?status=diajukan">Diajukan</a>
                <?php $active = ($status_filter == 'diterima') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?status=diterima">Diterima</a>
                <?php $active = ($status_filter == 'ditolak') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?status=ditolak">Ditolak</a>
                <?php $active = ($status_filter == 'verifikasi') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?status=verifikasi">Verifikasi</a>
                <?php $active = ($status_filter == 'verifikasi_ditolak') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?status=verifikasi_ditolak">Verifikasi Ditolak</a>
                <?php $active = ($status_filter == 'berita_acara_siap') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?status=berita_acara_siap">Berita Acara Siap</a>
                <?php $active = ($status_filter == 'disposisi') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?status=disposisi">Disposisi</a>
                <?php $active = ($status_filter == 'disposisi_ditolak') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?status=disposisi_ditolak">Disposisi Ditolak</a>
            </ul>

        </div>
        <div class="input-group w-auto">
            <form class="input-group w-auto" method="get" action="<?= site_url('dana_desa/index') ?>">
                <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari ..."
                    value="<?= $this->input->get('keyword'); ?>">
                <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<table class="table table-borderless">
    <thead>
        <tr>
            <th>No. Pengajuan</th>
            <?php if (!$this->session->userdata('role') == 'admin_desa'): ?>
                <th>Tanggal Pengajuan</th>
            <?php else: ?>
                <th>Nama Desa</th>
            <?php endif; ?>
            <th>Jenis Pengajuan</th>
            <th>Jumlah Bantuan</th>
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
                    <td>
                        <span class="badge bg-dark">
                            <?php echo $p->no_pengajuan; ?>
                        </span>
                    </td>
                    <td> <?php
                    if ($this->session->userdata('role') == 'admin_desa') {
                        echo isset($p->created_at) ? date('d M Y', strtotime($p->tanggal_pengajuan)) : '';
                    } else {
                        echo $p->nama_desa; // Ganti dengan field alternatif jika role bukan admin
                    }
                    ?>
                    </td>
                    <td>
                        <span class="badge bg-info">
                            <?php echo strtoupper(str_replace('_', ' ', $p->jenis_pengajuan)); ?>
                        </span>
                    </td>

                    <td>Rp <?php echo number_format($p->jumlah_bantuan, 0, ',', '.'); ?></td>
                    <td>
                        <?php
                        $status_class = '';
                        switch ($p->status) {
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
                            <?php echo strtoupper(str_replace('_', ' ', $p->status)); ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?php echo base_url('dana_desa/view/' . $p->id); ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                        <?php if (($this->session->userdata('role') == 'admin_desa') && $p->status == 'diajukan'): ?>
                            <!-- <a href="<?php echo base_url('dana_desa/edit/' . $p->id); ?>" class="btn btn-light btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a> -->
                            <a href="<?php echo base_url('dana_desa/delete/' . $p->id); ?>" class="btn btn-light btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<div class="mt-4">
    <?php echo $pagination; ?>
</div>

<style>
    .pagination .page-item.active .page-link {
        background-color: #b0b28a !important;
        border-color: #b0b28a !important;
        color: #fff !important;
    }

    .pagination .page-link {
        color: #b0b28a !important;
    }
</style>