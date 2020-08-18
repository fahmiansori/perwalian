<?php $this->load->view('app/_template/1head.php'); ?>
<!-- HEAD HERE -->
<link href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css'); ?>" rel="stylesheet" />
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
                        EDIT <?= ucwords(implode(' ',explode('_',$this->uri->segment(1)))) ?>
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
                        <input type="hidden" name="id" value="<?php echo $data_detail->id; ?>" />

                        <label for="waktu">Waktu</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input value="<?php echo date('H:i d F Y', strtotime($data_detail->waktu)); ?>" type="text" id="waktu" name="waktu" class="form-control datetimepicker <?php echo form_error('waktu') ? 'error':'' ?>" placeholder="Masukkan Waktu">
                            </div>

                            <?php if(form_error('waktu')){ ?>
                                <label id="waktu-error" class="error" for="waktu"><?php echo form_error('waktu') ?></label>
                            <?php } ?>
                        </div>

                        <label for="dosen_id">Dosen</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select id="dosen_id" name="dosen_id" class="form-control show-tick <?php echo form_error('dosen_id') ? 'error':'' ?>" required>
                                    <option value="">-- Please select --</option>
                                    <?php foreach ($dosen as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo $data_detail->dosen_id==$row->id ? 'selected':'' ?>><?php echo $row->nama_dosen; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <?php if(form_error('dosen_id')){ ?>
                                <label id="dosen_id-error" class="error" for="dosen_id"><?php echo form_error('dosen_id') ?></label>
                            <?php } ?>
                        </div>

                        <label for="nim">Mahasiswa</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select id="nim" name="nim" class="form-control show-tick <?php echo form_error('nim') ? 'error':'' ?>" required>
                                    <option value="">-- Please select --</option>
                                    <?php foreach ($mahasiswa as $row): ?>
                                        <option value="<?php echo $row->nim; ?>" <?php echo $data_detail->nim==$row->nim ? 'selected':'' ?>><?php echo $row->nama_mahasiswa; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <?php if(form_error('nim')){ ?>
                                <label id="nim-error" class="error" for="nim"><?php echo form_error('nim') ?></label>
                            <?php } ?>
                        </div>

                        <label for="semester">Semester Mahasiswa</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input value="<?php echo $data_detail->semester; ?>" type="number" id="semester" name="semester" class="form-control <?php echo form_error('semester') ? 'error':'' ?>" placeholder="Masukkan semester" required>
                            </div>

                            <?php if(form_error('semester')){ ?>
                                <label id="semester-error" class="error" for="semester"><?php echo form_error('semester') ?></label>
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
