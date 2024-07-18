<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- General JS Scripts -->
<script src="<?= base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/popper.js"></script>
<script src="<?= base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?= base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?= base_url(); ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>

<!-- Page Specific JS File -->
<?php if ($this->session->flashdata('sukses')) : ?>
    <script>
        iziToast.success({
            title: 'Berhasil !',
            message: '<?= $this->session->flashdata('sukses') ?>',
            position: 'topRight'
        });
    </script>
<?php elseif ($this->session->flashdata('gagal')) : ?>
    <script>
        iziToast.error({
            title: 'Gagal !',
            message: '<?= $this->session->flashdata('gagal') ?>',
            position: 'topRight'
        });
    </script>
<?php endif ?>

<!-- Template JS File -->
<script src="<?= base_url(); ?>assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>assets/js/custom.js"></script>
</body>

</html>