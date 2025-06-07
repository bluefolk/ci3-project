<?php $this->load->view('layout/header_view'); ?>
<?php $this->load->view('layout/sidebar_view'); ?>

<h2>TAMBAH DANA DESA</h2>
<?php
$fields_dana_desa = [
    'surat_permohonan_ke_bupati_cq_kepala_dpm',
    'kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya',
    'rekomendasi_camat',
    'foto_baliho_realisasi_apbdes_tahun_sebelumnya',
    'SPP1_SPP2_SPTB',
    'foto_baliho_apbdes_tahun_berjalan',
    'rencana_penggunaan_dana',
    'foto_buku_tabungan',
    'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan',
    'lpj_tahap_sebelumnya'
];
$fields_alokasi_dana_desa = [
    'surat_permohonan_ke_bank',
    'surat_permohonan_penerimaan',
    'rekomendasi_camat',
    'SPP1_SPP2_SPTB',
    'rencana_penggunaan_dana',
    'foto_buku_tabungan',
    'bukti_pembayaran_bulan_sebelumnya',
];

$fields_dana_lain = [
    'surat_permohonan_penerimaan',
    'rekomendasi_camat',
    'SPP1_SPP2_SPTB',
    'rencana_penggunaan_dana',
    'foto_buku_tabungan',
    'bukti_setoran_pades',
];

$fields_dd_non_earmark_40 = [
    'surat_permohonan_ke_bupati_cq_kepala_dpm',
    'kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya',
    'rekomendasi_camat',
    'foto_baliho_realisasi_apbdes_tahun_sebelumnya',
    'SPP1_SPP2_SPTB',
    'foto_baliho_apbdes_tahun_berjalan',
    'rencana_penggunaan_dana',
    'foto_buku_tabungan',
    'berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan',
    'lpj_tahap_sebelumnya'
];

$fields_ketahanan_pangan_tpk = [
    'surat_permohonan_ke_bupati_cq_kepala_dpm',
    'npwp_tpk',
    'rekomendasi_camat',
    'foto_copi_ktp_ketua_tpk',
    'SPP1_SPP2_SPTB',
    'nomor_rekening_tpk',
    'rencana_penggunaan_dana',
    'sk_pembentukan_tpk',
];

$fields_ketahanan_pangan_bumdesa = [
    'surat_permohonan_ke_bupati_cq_kepala_dpm',
    'sk_bumdesa',
    'rekomendasi_camat',
    'npwp_bumdesa_dan_bendahara_bumdesa',
    'SPP1_SPP2_SPTB',
    'buku_rekening_bumdesa',
    'rencana_penggunaan_dana',
    'akta_pendirian_badan_hukum',
];
$file_fields = [
    'dd_earmark_60' => array_fill_keys($fields_dana_desa, ''),
    'alokasi_dana_desa' => array_fill_keys($fields_alokasi_dana_desa, ''),
    'dana_lain' => array_fill_keys($fields_dana_lain, ''),
    'dd_non_earmark_40' => array_fill_keys($fields_dd_non_earmark_40, ''),
    'ketahanan_pangan_tpk' => array_fill_keys($fields_ketahanan_pangan_tpk, ''),
    'ketahanan_pangan_bumdesa' => array_fill_keys($fields_ketahanan_pangan_bumdesa, '')
];
?>

<?php echo form_open_multipart('dana_desa/create'); ?>

<div class="details-grid lg:grid-cols-2 mt-3">
    <div class="detail-item">
        <span class="detail-label">Nomor Pengajuan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="hidden" name="tanggal_verifikasi" id="tanggal_verifikasi">
            <input type="text" name="no_pengajuan" id="no_pengajuan"
                class="form-control form-control-sm <?php echo form_error('no_pengajuan') ? 'is-invalid' : ''; ?>"
                readonly required>
            <?php echo form_error('no_pengajuan', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>

    <div class="detail-item">
        <span class="detail-label">Kecamatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <select name="kecamatan_id_display" id="kecamatan_id"
                class="form-control form-control-sm <?php echo form_error('kecamatan_id') ? 'is-invalid' : ''; ?>"
                required>
                <option value="">Pilih Kecamatan</option>
                <?php foreach ($kecamatan as $k): ?>
                    <option value="<?php echo $k->id; ?>"><?php echo $k->nama_kecamatan; ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo form_error('kecamatan_id', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama Desa</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <select name="desa_id_display" id="desa_id"
                class="form-control form-control-sm <?php echo form_error('desa_id') ? 'is-invalid' : ''; ?>" required>
                <option value="">Pilih Desa</option>
                <?php foreach ($desa as $d): ?>
                    <option value="<?php echo $d->id; ?>"><?php echo $d->nama_desa; ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo form_error('desa_id', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="nama_kepala_desa" id="nama_kepala_desa"
                class="form-control form-control-sm <?php echo form_error('nama_kepala_desa') ? 'is-invalid' : ''; ?>"
                required>
            <?php echo form_error('nama_kepala_desa', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jabatan</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="jabatan" id="jabatan"
                class="form-control form-control-sm <?php echo form_error('jabatan') ? 'is-invalid' : ''; ?>" required>
            <?php echo form_error('jabatan', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Alamat</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="alamat" id="alamat"
                class="form-control form-control-sm <?php echo form_error('alamat') ? 'is-invalid' : ''; ?>" required>
            <?php echo form_error('alamat', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">No. Kontak</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="no_kontak_kades" id="no_kontak_kades"
                class="form-control form-control-sm <?php echo form_error('no_kontak_kades') ? 'is-invalid' : ''; ?>"
                required>
            <?php echo form_error('no_kontak_kades', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Nama BANK</span>
        <span class="detail-separator">:</span>
        <span class="detail-value">
            <input type="text" name="nama_bank" id="nama_bank"
                class="form-control form-control-sm <?php echo form_error('nama_bank') ? 'is-invalid' : ''; ?>"
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
                required>
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
                required>
            <?php echo form_error('jumlah_bantuan', '<div class="invalid-feedback">', '</div>'); ?>
        </span>
    </div>
    <div class="detail-item">
        <span class="detail-label">Jenis Pengajuan</span>
        <span class="detail-separator">:</span>
        <div class="button-group">
            <input type="radio" id="dd_earmark_60" name="jenis_pengajuan" value="dd_earmark_60" default checked>
            <label for="dd_earmark_60">DD Earmark<br>60%</label>
            <input type="radio" id="alokasi_dana_desa" name="jenis_pengajuan" value="alokasi_dana_desa">
            <label for="alokasi_dana_desa">Alokasi<br>Dana Desa</label>
            <input type="radio" id="dana_lain" name="jenis_pengajuan" value="dana_lain">
            <label for="dana_lain">Dana<br>Lain</label>
            <input type="radio" id="dd_non_earmark_40" name="jenis_pengajuan" value="dd_non_earmark_40">
            <label for="dd_non_earmark_40">DD Non-<br>Earmark 40%</label>
            <input type="radio" id="ketahanan_pangan_tpk" name="jenis_pengajuan" value="ketahanan_pangan_tpk">
            <label for="ketahanan_pangan_tpk">Ketahanan Pangan<br>TPK</label>
            <input type="radio" id="ketahanan_pangan_bumdesa" name="jenis_pengajuan" value="ketahanan_pangan_bumdesa">
            <label for="ketahanan_pangan_bumdesa">Ketahanan Pangan<br>BUMDEsa</label>
        </div>
    </div>

    <!-- <div id="uploadAlert" class="alert d-none alert-dismissible mt-4 d-flex align-items-center">
        <i id="uploadAlertIcon" class="me-2" style="font-size: 1.2rem;"></i>
        <div id="uploadAlertMessage">
            Silakan Unggah seluruh dokumen yang diperlukan sesuai dengan jenis pengajuan yang dipilih:
        </div>
    </div> -->

    <h5 style="margin-top: 40px;">UPLOAD DOKUMEN PENGAJUAN</h5>
    <div id="file-fields-wrapper" class="file-list">
        <p class="text-muted"></p>
    </div>

</div>

<div class="button-group mt-5 d-flex justify-content-center">
    <a href="<?php echo base_url('dana_desa'); ?>" class="btn btn-light btn-sm me-2">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <button id="submitBtn" type="submit" class="btn btn-primary btn-sm ms-4"
        style="background-color: #b0b28a; border-color: #b0b28a;">
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
        margin: 2px;
        border-radius: 10px;
        cursor: pointer;
        align-items: center;
        display: flex;
        justify-content: center;
        font-size: 16px;
        min-width: 120px;
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
        gap: 2.5rem;
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

    .custom-file {
        position: relative;
        display: block;
        /* ganti dari inline-block */
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
        display: block;
        /* ganti dari inline-block */
        width: 100%;
        /* agar label mengisi penuh */
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
        /* penting agar padding tidak melebihi lebar */
    }

    .custom-file-label.selected {
        color: #495057;
    }

    .button-group {
        display: flex;
        gap: 0.5rem;
    }

    #file-fields-wrapper {
        transition: opacity 0.3s ease-in-out;
    }

    .fade-out {
        opacity: 0;
    }

    .fade-in {
        opacity: 1;
    }
</style>

<?php $this->load->view('layout/footer_view'); ?>

<script>
    // Update custom file input label with selected filename
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Handle kecamatan change to filter desa
    $('#kecamatan_id').on('change', function () {
        var kecamatanId = $(this).val();
        if (kecamatanId) {
            $.ajax({
                url: '<?php echo base_url("dana_desa/get_desa_by_kecamatan/"); ?>' + kecamatanId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#desa_id').empty();
                    $('#desa_id').append('<option value="">Pilih Desa</option>');
                    $.each(data, function (key, value) {
                        $('#desa_id').append('<option value="' + value.id + '">' + value.nama_desa + '</option>');
                    });
                }
            });
        } else {
            $('#desa_id').empty();
            $('#desa_id').append('<option value="">Pilih Desa</option>');
        }
    });

    // Handle desa selection to auto-fill details
    $('#desa_id').on('change', function () {
        var desaId = $(this).val();
        if (desaId) {
            $.ajax({
                url: '<?php echo base_url("dana_desa/get_desa_details/"); ?>' + desaId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (!data.error) {
                        // Auto-fill desa details
                        $('#nama_kepala_desa').val(data.nama_kepala_desa);
                        $('#no_kontak_kades').val(data.no_kontak_kades);
                        $('#nama_bank').val(data.nama_bank);
                        $('#jabatan').val(data.jabatan);
                        $('#alamat').val(data.alamat);
                        $('#no_rekening').val(data.no_rekening);

                        // Auto-select kecamatan
                        $('#kecamatan_id').val(data.kecamatan_id);
                    }
                }
            });
        } else {
            // Clear fields if no desa selected
            $('#nama_kepala_desa').val('');
            $('#no_kontak_kades').val('');
            $('#nama_bank').val('');
            $('#no_rekening').val('');
            $('#jabatan').val('');
            $('#alamat').val('');
        }
    });

    function tampilkanField(jenis) {
        const wrapper = document.getElementById('file-fields-wrapper');
        wrapper.innerHTML = '';

        // Mulai transisi fade-out
        wrapper.classList.add('fade-out');
        // Tunggu animasi selesai (~300ms) sebelum ganti isi
        setTimeout(() => {
            fetch('<?= base_url('dana_desa/get_file_fields') ?>?jenis_pengajuan=' + jenis)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Gagal mengambil data dokumen.");
                    }
                    return response.text();
                })
                .then(html => {
                    wrapper.innerHTML = html;

                    // Tambahkan kembali fade-in
                    wrapper.classList.remove('fade-out');
                    // wrapper.classList.add('fade-in');

                    // Pasang event listener file input
                    // document.querySelectorAll('.custom-file-input').forEach(input => {
                    //     input.addEventListener('change', function () {
                    //         const fileName = this.files[0] ? this.files[0].name : '';
                    //         const label = this.nextElementSibling;
                    //         if (label && label.classList.contains('custom-file-label')) {
                    //             label.textContent = fileName;
                    //         }
                    //     });
                    // });
                    document.querySelectorAll('.custom-file-input').forEach(input => {
                        input.addEventListener('change', function () {
                            const file = this.files[0];
                            const label = this.nextElementSibling;

                            if (file) {
                                const fileName = file.name;
                                const fileExt = fileName.split('.').pop().toLowerCase();

                                if (fileExt !== 'pdf') {
                                    alert('Hanya file dengan format .pdf yang diperbolehkan.');
                                    this.value = ''; // Reset input file
                                    if (label && label.classList.contains('custom-file-label')) {
                                        label.textContent = 'Pilih file PDF';
                                    }
                                } else {
                                    if (label && label.classList.contains('custom-file-label')) {
                                        label.textContent = fileName;
                                    }
                                }
                            }
                        });
                    });
                })
                .catch(err => {
                    wrapper.innerHTML = '<p class="text-danger">Gagal memuat data: ' + err.message + '</p>';
                    wrapper.classList.remove('fade-out');
                    wrapper.classList.add('fade-in');
                });
        }, 300); // Sesuai durasi fade-out
    }

    document.addEventListener('DOMContentLoaded', function () {
        const radioButtons = document.querySelectorAll('input[name="jenis_pengajuan"]');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function () {
                tampilkanField(this.value);
            });
        });

        const checkedRadio = document.querySelector('input[name="jenis_pengajuan"]:checked');
        if (checkedRadio) {
            tampilkanField(checkedRadio.value);
        }
    });

    // // Jalankan saat halaman selesai dimuat
    // document.addEventListener("DOMContentLoaded", function () {
    //     const checkedRadio = document.querySelector('input[name="jenis_pengajuan"]:checked');
    //     if (checkedRadio) {
    //         console.log("Default checked:", checkedRadio.value);
    //         tampilkanField(checkedRadio.id);
    //     }
    // });


    function generateNoBAP(idBap, kodeJenis, kodeDesa, tahun) {
        return `${idBap}/${kodeDesa}/${kodeJenis}/${tahun}`;
    }

    function getKodeJenis(jenisPengajuan) {
        switch (jenisPengajuan.toLowerCase()) {
            case 'alokasi_dana_desa':
                return '010';
            case 'ketahanan_pangan_tpk':
            case 'ketahanan_pangan_bumdesa':
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

    function updateNoBAP() {
        const desaSelect = document.getElementById('desa_id');
        const jenisRadio = document.querySelector('input[name="jenis_pengajuan"]:checked');
        const inputNoBap = document.getElementById('no_pengajuan');

        if (!desaSelect || !jenisRadio || !inputNoBap) return;

        const kodeDesa = desaSelect.value;
        const jenisPengajuan = jenisRadio.value;
        const tahun = new Date().getFullYear();

        if (kodeDesa && jenisPengajuan) {
            const idBap = getRandomIDBAP();
            const kodeJenis = getKodeJenis(jenisPengajuan);
            const noBap = generateNoBAP(idBap, kodeJenis, kodeDesa, tahun);
            inputNoBap.value = noBap;
        } else {
            inputNoBap.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Trigger saat pertama load
        updateNoBAP();

        // Trigger saat desa diubah
        const desaSelect = document.getElementById('desa_id');
        desaSelect.addEventListener('change', updateNoBAP);

        // Trigger saat radio button dipilih
        const jenisRadios = document.querySelectorAll('input[name="jenis_pengajuan"]');
        jenisRadios.forEach(radio => {
            radio.addEventListener('change', updateNoBAP);
        });
    });

    // function generateNoBAPValue() {
    //     const getRandomDigits = (length) => {
    //         return Array.from({ length }, () => Math.floor(Math.random() * 10)).join('');
    //     };

    //     const bagian1 = getRandomDigits(3);
    //     const bagian2 = getRandomDigits(2);
    //     const bagian3 = 'P.' + getRandomDigits(3);
    //     const bagian4 = getRandomDigits(2);
    //     const bagian5 = new Date().getFullYear();

    //     return `${bagian1}/${bagian2}/${bagian3}/${bagian4}/${bagian5}`;
    // }

    // document.addEventListener('DOMContentLoaded', () => {
    //     const input = document.getElementById('no_pengajuan');
    //     if (input) {
    //         input.value = generateNoBAPValue();
    //     }
    // });

    // document.addEventListener("DOMContentLoaded", function () {
    //     const form = document.getElementById("pengajuanForm");

    //     form.addEventListener("submit", function (e) {
    //         const jenisDipilih = document.querySelector('input[name="jenis_pengajuan"]:checked');

    //         if (!jenisDipilih) {
    //             e.preventDefault(); // Stop submit
    //             alert("Silakan pilih Jenis Pengajuan."); // Tampilkan popup
    //         }
    //     });
    // });
    // document.addEventListener("DOMContentLoaded", function () {
    //     const submitBtn = document.getElementById("submitBtn");

    //     submitBtn.addEventListener("click", function (e) {
    //         const fieldNames = [
    //             "no_pengajuan",
    //             "desa_id",
    //             "kecamatan_id",
    //             "nama_kepala_desa",
    //             "jabatan",
    //             "alamat",
    //             "no_kontak_kades",
    //             "nama_bank",
    //             "no_rekening",
    //             "jumlah_bantuan"
    //         ];

    //         let allFilled = true;

    //         for (let name of fieldNames) {
    //             const input = document.querySelector(`[name="${name}"]`);
    //             if (!input || !input.value.trim()) {
    //                 allFilled = false;
    //                 break;
    //             }
    //         }

    //         const jenisDipilih = document.querySelector('input[name="jenis_pengajuan"]:checked');

    //         if (allFilled) {
    //             if (!jenisDipilih) {
    //                 e.preventDefault();
    //                 showUploadAlert('error', 'Silakan pilih jenis pengajuan.');
    //             } else {
    //                 const alertBox = document.getElementById('uploadAlert');
    //                 if (alertBox) {
    //                     alertBox.classList.add('d-none');
    //                 }
    //             }
    //         } else {
    //             // Jika field lain belum diisi, sembunyikan alert jika muncul
    //             const alertBox = document.getElementById('uploadAlert');
    //             if (alertBox) {
    //                 alertBox.classList.add('d-none');
    //             }
    //         }
    //     });
    // });

    // function showUploadAlert(type, message) {
    //     const alertBox = document.getElementById('uploadAlert');
    //     const alertIcon = document.getElementById('uploadAlertIcon');
    //     const alertMessage = document.getElementById('uploadAlertMessage');

    //     // Reset class
    //     alertBox.classList.remove('d-none', 'alert-primary', 'alert-danger');
    //     alertIcon.className = 'me-2';

    //     // Atur berdasarkan tipe
    //     if (type === 'error') {
    //         alertBox.classList.add('alert-danger');
    //         alertIcon.classList.add('bi', 'bi-exclamation-triangle-fill');
    //     } else {
    //         alertBox.classList.add('alert-primary');
    //         alertIcon.classList.add('bi', 'bi-info-circle-fill');
    //     }

    //     // Set pesan
    //     alertMessage.textContent = message;

    //     // Scroll ke alert
    //     alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    // }

    // document.addEventListener("DOMContentLoaded", function () {
    //     const radios = document.querySelectorAll("input[name='jenis_pengajuan']");
    //     const allFileSections = document.querySelectorAll(".form-section");

    //     radios.forEach(radio => {
    //         radio.addEventListener("change", function () {
    //             const selected = this.value;

    //             // Sembunyikan semua form-section dan hilangkan required
    //             allFileSections.forEach(section => {
    //                 section.style.display = "none";
    //                 const input = section.querySelector("input[type='file']");
    //                 if (input) input.required = false;
    //             });

    //             // Tampilkan hanya form-section yang sesuai jenis & tambahkan required
    //             const activeSections = document.querySelectorAll(".file-field-" + selected);
    //             activeSections.forEach(section => {
    //                 section.style.display = "grid";
    //                 const input = section.querySelector("input[type='file']");
    //                 if (input) input.required = true;
    //  });
    //         });
    //     });
    // });
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil kecamatan & desa dari session
        $.ajax({
            url: '<?= base_url("dana_desa/get_user_location") ?>',
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                if (res.kecamatan_id) {
                    $('#kecamatan_id').val(res.kecamatan_id).trigger('change'); // akan trigger AJAX desa

                    // Setelah desa ditrigger oleh change di atas, tunggu dulu beberapa ms agar data desa selesai di-load
                    setTimeout(function () {
                        $('#desa_id').val(res.desa_id);
                        $('#kecamatan_id').prop('disabled', true);
                        $('#desa_id').prop('disabled', true);
                        // Trigger saat pertama load
                        updateNoBAP();

                        // Trigger saat desa diubah
                        const desaSelect = document.getElementById('desa_id');
                        desaSelect.addEventListener('change', updateNoBAP);
                    }, 200); // waktu ini bisa disesuaikan

                }
            },
            error: function () {
                console.error('Gagal mengambil lokasi user.');
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const now = new Date();
        const localDatetime = now.toISOString().slice(0, 19).replace('T', ' ');
        document.getElementById('tanggal_verifikasi').value = localDatetime;
    });
</script>