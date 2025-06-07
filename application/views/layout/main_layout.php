<?php $this->load->view('layout/header_view', $data ?? []); ?>

<!-- Sidebar column start -->
<?php $this->load->view('layout/sidebar_view', $data ?? []); ?>
<!-- Sidebar column end -->

<!-- Main Content -->
<div class="col main-content">
    <?php $this->load->view('layout/main_header_view'); ?>

    <!-- Page Specific Content -->
    <div class="row dd-earmark-section p-4">
        <div class="col">
            <?php echo $content ?? ''; ?>
        </div>
    </div>
</div>

<?php $this->load->view('layout/footer_view'); ?> 