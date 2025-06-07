<div class="col-auto px-0 sidebar">
    <div class="d-flex flex-column align-items-center py-3">
        <div class="logo-placeholder mb-4 text-center">
            <img src="<?= base_url('assets/logo_halut.jpeg'); ?>" alt="Logo" style="max-width: 100%; height: auto; border-radius: 10%;">
        </div>

        <?php foreach ($sidebar_menu as $item): ?>
            <?php if ($this->session->userdata('role') == 'admin_desa' && in_array($item['title'], ['History', 'Berita Acara']))
                continue;

            $active = ($active_sidebar == $item['link']) ? 'active' : '';
            ?>
            <a href="<?= base_url($item['link']) ?>" class="sidebar-item <?= $active ?>" title="<?= $item['title'] ?>">
                <i class="<?= $item['icon'] ?>"
                    style="color:<?= ($active_sidebar == $item['link']) ? '#FFFFFF' : '#000' ?>"></i>

            </a>
        <?php endforeach; ?>
    </div>
</div>