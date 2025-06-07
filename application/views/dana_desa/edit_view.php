<?php $this->load->view('layout/header_view'); ?>
<?php $this->load->view('layout/sidebar_view'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>EDIT DANA DESA</h1>
    <a href="<?php echo base_url('dana_desa'); ?>" class="btn btn-light btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<?php echo form_open_multipart('dana_desa/edit/'.$pengajuan->id); ?>

<div class="details-grid">
    <div class="detail-item">
        <span class="detail-label">Nama Desa</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <select name="desa_id" id="desa_id" class="form-control form-control-sm <?php echo form_error('desa_id') ? 'is-invalid' : ''; ?>" required>
                <option value="">Pilih Desa</option>
                <?php foreach($desa as $d): ?>
                <option value="<?php echo $d->id; ?>" <?php echo ($d->id == $pengajuan->desa_id) ? 'selected' : ''; ?>><?php echo $d->nama_desa; ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo form_error('desa_id', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Kecamatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <select name="kecamatan_id" id="kecamatan_id" class="form-control form-control-sm <?php echo form_error('kecamatan_id') ? 'is-invalid' : ''; ?>" required>
                <option value="">Pilih Kecamatan</option>
                <?php foreach($kecamatan as $k): ?>
                <option value="<?php echo $k->id; ?>" <?php echo (isset($desa_details) && $k->id == $desa_details->kecamatan_id) ? 'selected' : ''; ?>><?php echo $k->nama_kecamatan; ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo form_error('kecamatan_id', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="nama_kepala_desa" id="nama_kepala_desa" class="form-control form-control-sm <?php echo form_error('nama_kepala_desa') ? 'is-invalid' : ''; ?>" value="<?php echo $pengajuan->nama_kepala_desa; ?>" required>
            <?php echo form_error('nama_kepala_desa', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Kontak</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="no_kontak_kades" id="no_kontak_kades" class="form-control form-control-sm <?php echo form_error('no_kontak_kades') ? 'is-invalid' : ''; ?>" value="<?php echo $pengajuan->no_kontak_kades; ?>" required>
            <?php echo form_error('no_kontak_kades', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama BANK</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="nama_bank" id="nama_bank" class="form-control form-control-sm <?php echo form_error('nama_bank') ? 'is-invalid' : ''; ?>" value="<?php echo $pengajuan->nama_bank; ?>" required>
            <?php echo form_error('nama_bank', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Rekening</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="no_rekening" id="no_rekening" class="form-control form-control-sm <?php echo form_error('no_rekening') ? 'is-invalid' : ''; ?>" value="<?php echo $pengajuan->no_rekening; ?>" required>
            <?php echo form_error('no_rekening', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jumlah Bantuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="number" name="jumlah_bantuan" id="jumlah_bantuan" class="form-control form-control-sm <?php echo form_error('jumlah_bantuan') ? 'is-invalid' : ''; ?>" value="<?php echo $pengajuan->jumlah_bantuan; ?>" required>
            <?php echo form_error('jumlah_bantuan', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
</div>

<div class="file-list mt-4">
    <?php foreach($jenis_dokumen as $k => $jenis): ?>
    <div class="file-item">
        <span class="file-label"><?php echo ucwords(str_replace('_', ' ', $jenis)); ?></span>
        <span class="file-separator">:</span>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="<?php echo $jenis; ?>" name="<?php echo $jenis; ?>">
            <label class="custom-file-label" for="<?php echo $jenis; ?>">
                <?php 
                $current_file = null;
                foreach($dokumen as $d) {
                    if($d->jenis_dokumen == $jenis) {
                        $current_file = $d;
                        break;
                    }
                }
                // echo $current_file ? $current_file->nama_file : 'Pilih File';
                echo 'Pilih File';
                ?>
            </label>
        </div>
        <?php if($current_file): ?>
        <a href="<?php echo base_url('uploads/dokumen/'.$current_file->nama_file); ?>" target="_blank" class="btn btn-info btn-sm preview-btn">
            <i class="fas fa-eye"></i> Lihat File
        </a>
        <?php endif; ?>
        <small class="form-text text-muted">Format: PDF, maksimal 2MB</small>
    </div>
    <?php endforeach; ?>
</div>

<div class="button-group mt-4">
    <button type="submit" class="btn btn-primary btn-sm" style="background-color: #b0b28a; border-color: #b0b28a;">
        <i class="fas fa-save"></i> Simpan
    </button>
    <a href="<?php echo base_url('dana_desa'); ?>" class="btn btn-light btn-sm ms-2">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
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
// Update custom file input label with selected filename
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

// Handle kecamatan change to filter desa
$('#kecamatan_id').on('change', function() {
    var kecamatanId = $(this).val();
    if(kecamatanId) {
        $.ajax({
            url: '<?php echo base_url("dana_desa/get_desa_by_kecamatan/"); ?>' + kecamatanId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#desa_id').empty();
                $('#desa_id').append('<option value="">Pilih Desa</option>');
                $.each(data, function(key, value) {
                    var selected = value.id == '<?php echo $pengajuan->desa_id; ?>' ? 'selected' : '';
                    $('#desa_id').append('<option value="' + value.id + '" ' + selected + '>' + value.nama_desa + '</option>');
                });
            }
        });
    } else {
        $('#desa_id').empty();
        $('#desa_id').append('<option value="">Pilih Desa</option>');
    }
});

// Handle desa selection to auto-fill details
$('#desa_id').on('change', function() {
    var desaId = $(this).val();
    if(desaId) {
        $.ajax({
            url: '<?php echo base_url("dana_desa/get_desa_details/"); ?>' + desaId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(!data.error) {
                    // Auto-fill desa details
                    $('#nama_kepala_desa').val(data.nama_kepala_desa);
                    $('#no_kontak_kades').val(data.no_kontak_kades);
                    $('#nama_bank').val(data.nama_bank);
                    $('#no_rekening').val(data.no_rekening);
                    
                    // Auto-select kecamatan
                    $('#kecamatan_id').val(data.kecamatan_id).trigger('change');
                }
            }
        });
    } else {
        // Clear fields if no desa selected
        $('#nama_kepala_desa').val('');
        $('#no_kontak_kades').val('');
        $('#nama_bank').val('');
        $('#no_rekening').val('');
    }
});

// Trigger kecamatan change on page load to populate desa dropdown
$(document).ready(function() {
    if($('#kecamatan_id').val()) {
        $('#kecamatan_id').trigger('change');
    }
});
</script>

<?php $this->load->view('layout/footer_view'); ?> 