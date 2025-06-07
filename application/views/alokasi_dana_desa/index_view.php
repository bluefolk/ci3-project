<?php $this->load->view('layout/header_view'); ?>
<?php $this->load->view('layout/sidebar_view'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>ALOKASI DANA DESA</h1>
    <div class="d-flex gap-2">
        <?php if(in_array($this->session->userdata('role'), ['admin_desa', 'super_admin'])): ?>
        <a href="<?php echo base_url('dana_lain/create'); ?>" class="btn btn-primary btn-sm" style="background-color: #b0b28a; border-color: #b0b28a;">
            <i class="fas fa-plus"></i> Tambah
        </a>
        <?php endif; ?>
        <div class="input-group w-auto">
            <input type="text" class="form-control form-control-sm" placeholder="Cari ..." aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-outline-secondary btn-sm" type="button" id="search-addon"><i class="fas fa-search"></i></button>
        </div>
    </div>
</div>

<?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<table class="table table-borderless">
    <thead>
        <tr>
            <th>Tgl. Pengajuan</th>
            <th>Nama Desa</th>
            <th>Kecamatan</th>
            <th>Jumlah Bantuan</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(empty($pengajuan)): ?>
        <tr>
            <td colspan="6" class="text-center py-4">
                <div class="text-muted">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <p class="mb-0">Data tidak ditemukan</p>
                </div>
            </td>
        </tr>
        <?php else: ?>
        <?php foreach($pengajuan as $p): ?>
        <tr>
            <td><?php echo isset($p->created_at) ? date('d M Y', strtotime($p->created_at)) : ''; ?></td>
            <td><?php echo $p->nama_desa; ?></td>
            <td><?php echo $p->nama_kecamatan; ?></td>
            <td>Rp <?php echo number_format($p->jumlah_bantuan, 0, ',', '.'); ?></td>
            <td>
                <?php
                $status_class = '';
                switch(isset($p->status) ? $p->status : '') {
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
                <a href="<?php echo base_url('dana_lain/view/'.$p->id); ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-eye"></i> Detail
                </a>
                <?php if((in_array($this->session->userdata('role'), ['admin_desa', 'super_admin'])) && (isset($p->status) && $p->status == 'diajukan')): ?>
                <a href="<?php echo base_url('dana_lain/edit/'.$p->id); ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="<?php echo base_url('dana_lain/delete/'.$p->id); ?>" class="btn btn-light btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table> 