<?php $this->load->view('layout/header_view'); ?>
<?php $this->load->view('layout/sidebar_view'); ?>

<h2>TAMBAH BERITA ACARA</h2>

<?php echo form_open_multipart('berita_acara/create'); ?>
<input type="hidden" name="catatan" value="Berita Acara Diproses">

<div class="details-grid mt-3">
    <div class="detail-item">
        <span class="detail-label">Nomor Berita Acara</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="no_bap" id="no_bap"
                class="form-control form-control-sm <?php echo form_error('no_bap') ? 'is-invalid' : ''; ?>" required
                readonly>
            <?php echo form_error('no_bap', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nomor Pengajuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <select name="pengajuan_id" id="pengajuan_id"
                class="form-control form-control-sm <?php echo form_error('pengajuan_id') ? 'is-invalid' : ''; ?>"
                required>
                <option value="">Pilih Nomor Pengajuan</option>
                <?php foreach ($pengajuan as $p): ?>
                    <?php
                    $disabled = in_array($p->berita_acara_id, $berita_acara_terisi) ? 'disabled' : '';
                    ?>
                    <option value="<?= $p->no_pengajuan ?>" data-jenis="<?= $p->jenis_pengajuan ?>"
                        data-kodedesa="<?= $p->kode_desa ?>" <?= $disabled ?>>
                        <?= $p->no_pengajuan ?>
                        <?= $disabled ? ' (Berita Acara Diproses)' : '' ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php echo form_error('pengajuan_id', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jenis Pengajuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="hidden" name="jenis_pengajuan" id="jenis_pengajuan">
            <input type="text" name="jenis_pengajuan_display" id="jenis_pengajuan_display"
                class="form-control form-control-sm <?php echo form_error('jenis_pengajuan') ? 'is-invalid' : ''; ?>"
                readonly required>
            <?php echo form_error('jenis_pengajuan', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama Desa</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <select id="desa_id_display" disabled
                class="form-control form-control-sm <?php echo form_error('desa_id') ? 'is-invalid' : ''; ?>">
                <option value="">Pilih Desa</option>
                <?php foreach ($desa as $d): ?>
                    <option value="<?php echo $d->id; ?>"><?php echo $d->nama_desa; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="desa_id" id="desa_id">
            <?php echo form_error('desa_id', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Kecamatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <select id="kecamatan_id_display" disabled
                class="form-control form-control-sm <?php echo form_error('kecamatan_id') ? 'is-invalid' : ''; ?>">
                <option value="">Pilih Kecamatan</option>
                <?php foreach ($kecamatan as $k): ?>
                    <option value="<?php echo $k->id; ?>"><?php echo $k->nama_kecamatan; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="kecamatan_id" id="kecamatan_id">
            <?php echo form_error('kecamatan_id', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="nama_kepala_desa" id="nama_kepala_desa"
                class="form-control form-control-sm <?php echo form_error('nama_kepala_desa') ? 'is-invalid' : ''; ?>"
                readonly required>
            <?php echo form_error('nama_kepala_desa', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Kontak</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="no_kontak_kades" id="no_kontak_kades"
                class="form-control form-control-sm <?php echo form_error('no_kontak_kades') ? 'is-invalid' : ''; ?>"
                readonly required>
            <?php echo form_error('no_kontak_kades', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama BANK</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="nama_bank" id="nama_bank"
                class="form-control form-control-sm <?php echo form_error('nama_bank') ? 'is-invalid' : ''; ?>" readonly
                required>
            <?php echo form_error('nama_bank', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Rekening</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="no_rekening" id="no_rekening"
                class="form-control form-control-sm <?php echo form_error('no_rekening') ? 'is-invalid' : ''; ?>"
                readonly required>
            <?php echo form_error('no_rekening', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jenis Bantuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="jenis_bantuan" id="jenis_bantuan"
                class="form-control form-control-sm <?php echo form_error('jenis_bantuan') ? 'is-invalid' : ''; ?>"
                required>
            <?php echo form_error('jenis_bantuan', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jumlah Bantuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="number" name="jumlah_bantuan" id="jumlah_bantuan"
                class="form-control form-control-sm <?php echo form_error('jumlah_bantuan') ? 'is-invalid' : ''; ?>"
                readonly required>
            <?php echo form_error('jumlah_bantuan', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>


</div>

<h5 style="margin-top: 40px;">UPLOAD DOKUMEN</h5>

<div class="file-list ">
    <div class="file-item">
        <span class="file-label">Berita Acara</span>
        <span class="file-separator">:</span>
        <div>
            <div class="custom-file mt-4">
                <input type="file" class="custom-file-input" accept=".pdf" id="berita_acara" name="berita_acara"
                    required>
                <label class="custom-file-label" for="berita_acara">Pilih File</label>
            </div>
            <small class="form-text text-muted" style="margin-top: 6px; margin-left:8px; display: block;">Format:
                PDF, maksimal 2MB</small>
        </div>
    </div>

</div>

<div class="button-group mt-5 d-flex justify-content-center">
    <a href="<?php echo base_url('berita_acara'); ?>" class="btn btn-light btn-sm me-2">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <button type="submit" class="btn btn-primary btn-sm ms-4" style="background-color: #b0b28a; border-color: #b0b28a;">
        <i class="fas fa-save"></i> Simpan
    </button>

</div>

<?php echo form_close(); ?>

<style>
    .container h3 {
        margin-top: 0;
        font-weight: normal;
    }

    .button-group {
        margin-top: 10px;
    }

    input[type="radio"] {
        display: none;
    }

    label {
        display: inline-block;
        background-color: #7b8fe0;
        color: white;
        padding: 10px 20px;
        margin-left: 5px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        min-width: 150px;
    }

    input[type="radio"]:checked+label {
        background-color: #4a60c0;
        font-weight: bold;

    }

    .details-grid {
        display: grid;
        grid-template-columns: 1fr;
        /* Each item takes full width */
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
        /* Each item takes full width */
        gap: 1rem;
    }

    .file-item {
        display: grid;
        grid-template-columns: 200px auto 1fr;
        align-items: center;
        gap: 0.9rem;
    }

    .file-label {
        font-weight: 500;
    }

    .file-separator {
        color: #6c757d;
    }

    .custom-file {
        position: relative;
        display: block;
        width: 100%;
        /* Ensure custom file takes full grid column */
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
        display: block;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        cursor: pointer;
        box-sizing: border-box;

    }

    .custom-file-label.selected {
        color: #495057;
    }

    .button-group {
        display: flex;
        gap: 0.5rem;
    }
</style>

<?php $this->load->view('layout/footer_view'); ?>

<script>
    // Update custom file input label with selected filename
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    $(document).ready(function () {
        $('#pengajuan_id').select2({
            placeholder: "Pilih Nomor Pengajuan",
            allowClear: true,
            width: '100%'  // supaya full width di dalam bootstrap form-control
        });
        $('#pengajuan_id').on('change', function () {
            const selected = $(this).find('option:selected');
            const jenisPengajuan = selected.data('jenis');
            const kodeDesa = selected.data('kodedesa');
            const tahun = new Date().getFullYear();

            if (jenisPengajuan && kodeDesa) {
                const idBap = Math.floor(100 + Math.random() * 900);
                const kodeJenis = (function (jenis) {
                    switch (jenis.toLowerCase()) {
                        case 'alokasi_dana_desa': return '010';
                        case 'ketahanan_pangan': return '022';
                        case 'dd_earmark_60': return '023';
                        case 'dana_lain': return '030';
                        default: return '000';
                    }
                })(jenisPengajuan);

                const noBap = `${idBap}/${kodeJenis}/${kodeDesa}/${tahun}`;
                $('#no_bap').val(noBap);
            } else {
                $('#no_bap').val('');
            }
        });
        // Saat pengajuan dipilih
        $('#pengajuan_id').on('change', function () {
            var no_pengajuan = $(this).val();

            if (no_pengajuan !== '') {
                $.ajax({
                    url: '<?= base_url("dana_desa/get_detail_pengajuan") ?>',
                    type: 'POST',
                    data: { no_pengajuan: no_pengajuan },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            var data = response.data;

                            // 1. Set kecamatan
                            $('#kecamatan_id').val(data.kecamatan_id).trigger('change');
                            $('#kecamatan_id').val(data.kecamatan_id);
                            $('#kecamatan_id_display').val(data.kecamatan_id);

                            // 2. Setelah trigger 'change', tunggu desa ter-load baru set desa_id
                            var interval = setInterval(function () {
                                if ($('#desa_id option').length > 1) {
                                    $('#desa_id').val(data.desa_id).trigger('change');
                                    $('#desa_id').val(data.desa_id);
                                    $('#desa_id_display').val(data.desa_id);
                                    clearInterval(interval);
                                }
                            }, 300);

                            $('#jumlah_bantuan').val(data.jumlah_bantuan);
                            $('#jenis_bantuan').val(data.jenis_bantuan);
                            $('#jenis_pengajuan').val(data.jenis_pengajuan);
                            $('#jenis_pengajuan_display').val(formatJenisPengajuan(data.jenis_pengajuan));

                        } else {
                            alert('Data pengajuan tidak ditemukan.');
                        }
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat memuat data.');
                    }
                });
            }
        });

        // Saat kecamatan berubah, load desa
        $('#kecamatan_id').on('change', function () {
            var kecamatanId = $(this).val();
            if (kecamatanId) {
                $.ajax({
                    url: '<?= base_url("dana_desa/get_desa_by_kecamatan/") ?>' + kecamatanId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#desa_id').empty().append('<option value="">Pilih Desa</option>');
                        $.each(data, function (key, value) {
                            $('#desa_id').append('<option value="' + value.id + '">' + value.nama_desa + '</option>');
                        });
                    }
                });
            } else {
                $('#desa_id').empty().append('<option value="">Pilih Desa</option>');
            }
        });

        // Saat desa berubah, isi data desa lainnya
        $('#desa_id').on('change', function () {
            var desaId = $(this).val();
            if (desaId) {
                $.ajax({
                    url: '<?= base_url("dana_desa/get_desa_details/") ?>' + desaId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (!data.error) {
                            $('#nama_kepala_desa').val(data.nama_kepala_desa);
                            $('#no_kontak_kades').val(data.no_kontak_kades);
                            $('#nama_bank').val(data.nama_bank);
                            $('#no_rekening').val(data.no_rekening);

                            // Pastikan kecamatan sinkron jika user pilih desa manual
                            $('#kecamatan_id').val(data.kecamatan_id);
                        }
                    }
                });
            } else {
                $('#nama_kepala_desa').val('');
                $('#no_kontak_kades').val('');
                $('#nama_bank').val('');
                $('#no_rekening').val('');
            }
        });
    });

    function formatJenisPengajuan(str) {
        return str.replace(/_/g, ' ').toUpperCase();
    }
    function tampilkanField(jenis) {
        [surat, laporan, proposal].forEach(el => {
            el.style.visibility = 'hidden';
            el.style.position = 'absolute';
        });

        if (jenis === 'dana_desa') {
            surat.style.visibility = 'visible';
            surat.style.position = 'relative';
        } else if (jenis === 'dana_lain') {
            laporan.style.visibility = 'visible';
            laporan.style.position = 'relative';
        } else if (jenis === 'add') {
            proposal.style.visibility = 'visible';
            proposal.style.position = 'relative';
        }
    }
    // Ambil semua radio button dengan name "jenis_pengajuan"
    const radioButtons = document.querySelectorAll('input[name="jenis_pengajuan"]');

    // Tambahkan event listener ke masing-masing radio
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function () {

            console.log("Yang dipilih:", this.value);
            // Bisa juga ganti alert atau simpan ke input hidden, dsb
            // alert("Yang dipilih: " + this.id);
            tampilkanField(this.id);

        });
    });

    function generateNoBAP(idBap, kodeJenis, kodeDesa, tahun) {
        return `${idBap}/${kodeJenis}/${kodeDesa}/${tahun}`;
    }

    function getKodeJenis(jenisPengajuan) {
        switch (jenisPengajuan.toLowerCase()) {
            case 'alokasi_dana_desa':
                return '010';
            case 'ketahanan_pangan':
                return '022';
            case 'dd_earmark_60':
                return '021';
            case 'dd_non_earmark_40':
                return '023';
            case 'dana_lain':
                return '030';
            default:
                return '000';
        }
    }

    function getRandomIDBAP() {
        return Math.floor(100 + Math.random() * 900); // Random 3 digit
    }

    document.addEventListener('DOMContentLoaded', () => {
        const select = document.getElementById('pengajuan_id');
        const inputNoBap = document.getElementById('no_bap');

        select.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const jenisPengajuan = selected.getAttribute('data-jenis');
            const kodeDesa = selected.getAttribute('data-kodedesa');
            const tahun = new Date().getFullYear();

            if (jenisPengajuan && kodeDesa) {
                const idBap = getRandomIDBAP();
                const kodeJenis = getKodeJenis(jenisPengajuan);
                const noBap = generateNoBAP(idBap, kodeJenis, kodeDesa, tahun);
                inputNoBap.value = noBap;
            } else {
                inputNoBap.value = ''; // Kosongkan jika tidak valid
            }
        });
    });

</script>