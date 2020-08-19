<?php $this->load->view('app/_template/1head.php'); ?>
<!-- HEAD HERE -->
<!-- #END HEAD HERE -->


<?php $this->load->view('app/_template/2topbar.php'); ?>


<?php $this->load->view('app/_template/3sidebar.php'); ?>


<?php $this->load->view('app/_template/4content.php'); ?>
<!-- CONTENT HERE -->
<div class="">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('failed')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('failed'); ?>
        </div>
    <?php endif; ?>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        EDIT Isi Perwalian
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?= site_url('jadwal_perwalian') ?>">Back</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $data_detail_perwalian->id; ?>" />

                        <label for="isi_perwalian">Isi Perwalian</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea type="text" id="isi_perwalian" name="isi_perwalian" class="form-control <?php echo form_error('isi_perwalian') ? 'error':'' ?>" placeholder="Masukkan isi perwalian yang dibahas" rows="8" cols="80"><?php echo $data_detail_perwalian->isi_perwalian; ?></textarea>
                            </div>

                            <?php if(form_error('isi_perwalian')){ ?>
                                <label id="isi_perwalian-error" class="error" for="isi_perwalian"><?php echo form_error('isi_perwalian') ?></label>
                            <?php } ?>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END CONTENT HERE -->


<?php $this->load->view('app/_template/5js.php'); ?>
<!-- JS HERE -->
<script src="<?php echo base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/momentjs/moment.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>"></script>
<script type="text/javascript">
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm DD MMMM YYYY',
        clearButton: true,
        weekStart: 1
    });
</script>
<!-- #END JS HERE -->


<?php $this->load->view('app/_template/6end.php'); ?>
