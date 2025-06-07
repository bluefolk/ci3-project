<?php $this->load->view('layout/header_view'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>BERITA ACARA</h2>
    <div class="d-flex gap-3">
        <?php if (in_array($this->session->userdata('role'), ['super_admin'])): ?>
            <button class="btn" style="background-color: #b0b28a;
                   border: none;
                   color: white;
                   padding: 6px 16px;
                   height: 34px;
                   line-height: 1;
                   font-size: 14px;
                   border-radius: 10px;" onclick="window.location.href='<?= base_url('berita_acara/create'); ?>'">
                <i class="fas fa-plus me-1"></i> Tambah
            </button>
        <?php endif; ?>

        <!-- Dropdown Filter Status -->
        <div class="dropdown">
            <a href="<?= base_url('berita_acara/export_excel'); ?>" class="btn me-2 btn-success btn-sm">
                <i class="fas fa-file-download"></i> Export
            </a>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterStatusDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-filter"></i> Jenis Pengajuan
            </button>

            <ul class="dropdown-menu" aria-labelledby="filterStatusDropdown">
                <?php $active = ($status_filter == 'semua') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="<?php echo base_url('berita_acara'); ?>">Semua</a>
                <?php $active = ($status_filter == 'dd_earmark_60') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?jenis_pengajuan=dd_earmark_60">DD Earmark 60</a>
                <?php $active = ($status_filter == 'alokasi_dana_desa') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?jenis_pengajuan=alokasi_dana_desa">Alokasi Dana Desa</a>
                <?php $active = ($status_filter == 'dana_lain') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?jenis_pengajuan=dana_lain">Dana lain</a>
                <?php $active = ($status_filter == 'dd_non_earmark_40') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?jenis_pengajuan=dd_non_earmark_40">DD Non Earmark 40</a>
                <?php $active = ($status_filter == 'ketahanan_pangan_tpk') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?jenis_pengajuan=ketahanan_pangan_tpk">Ketahanan Pangan
                    TPK</a>
                <?php $active = ($status_filter == 'ketahanan_pangan_bumdesa') ? 'active' : ''; ?>
                <a class="dropdown-item <?= $active ?>" href="?jenis_pengajuan=ketahanan_pangan_bumdesa">Ketahanan
                    Pangan BUMDesa</a>
            </ul>

        </div>
        <div class="input-group w-auto">
            <form class="input-group w-auto" method="get" action="<?= site_url('berita_acara/index') ?>">
                <input type="text" name="keyword" class="form-control form-control-sm"
                    placeholder="Cari Berita Acara..." value="<?= $this->input->get('keyword'); ?>">
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
            <th>Nomor Berita Acara</th>
            <th>Nomor Pengajuan</th>
            <th>Jenis Pengajuan</th>
            <th>Nama Desa</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($bap)): ?>
            <tr>
                <td colspan="6" class="text-center py-4">
                    <div class="text-muted">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p class="mb-0">Data tidak ditemukan</p>
                    </div>
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($bap as $p): ?>
                <tr>
                    <td>
                        <span class="badge bg-dark">
                            <?php echo $p->no_bap; ?>
                    </td>
                    </span>
                    <td><?php echo $p->no_pengajuan; ?></td>

                    <td><span class="badge bg-primary">
                            <?php echo strtoupper(str_replace('_', ' ', $p->jenis_pengajuan)); ?></span>
                    </td>
                    <td><?php echo $p->nama_desa; ?></td>

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
                            <?php echo strtoupper(str_replace('_', ' ', $p->status)); ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?php echo base_url('berita_acara/view/' . $p->id); ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <?php if (($this->session->userdata('role') == 'super_admin') && $p->status == 'diajukan'): ?>

                            <a href="<?php echo base_url('berita_acara/delete/' . $p->id); ?>" class="btn btn-light btn-sm"
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