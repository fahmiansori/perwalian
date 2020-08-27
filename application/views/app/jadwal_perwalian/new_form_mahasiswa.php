<?php $this->load->view('app/_template/1head.php'); ?>
<!-- HEAD HERE -->
<link href="<?php echo base_url('assets/plugins/bootstrap-select/css/bootstrap-select.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css'); ?>" rel="stylesheet" />
<!-- #END HEAD HERE -->


<?php $this->load->view('app/_template/2topbar.php'); ?>


<?php $this->load->view('app/_template/3sidebar.php'); ?>


<?php $this->load->view('app/_template/4content.php'); ?>
<!-- CONTENT HERE -->
<?php
    $user_logged = $this->session->userdata("user_logged");
    $mahasiswa_id = '';
    $mahasiswa_nama = '';
    $dosen_id = '';
    $dosen_nama = '';
    if ($user_logged->role === '3') {
        $mahasiswa_ = $this->db->get_where('mahasiswa', ["user_id" => $user_logged->id])->row();
        $dosen_id = $mahasiswa_->dosen_id;
        $mahasiswa_id = $mahasiswa_->nim;
        $mahasiswa_nama = $mahasiswa_->nama_mahasiswa;
    }
?>
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

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        NEW Pengajuan Bimbingan
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
                    <form action="<?php echo site_url('jadwal_perwalian/add') ?>" method="post" enctype="multipart/form-data" >
                        <label for="dosen_id">Dosen</label>
                        <div class="form-group">
                            <div class="form-line" style="display:none;">
                                <select id="dosen_id" name="dosen_id" class="form-control show-tick <?php echo form_error('dosen_id') ? 'error':'' ?>" required>
                                    <option value="">-- Please select --</option>
                                    <?php foreach ($dosen as $row): ?>
                                        <?php
                                            if ($row->id == $dosen_id) {
                                                $dosen_nama = $row->nama_dosen;
                                            }
                                        ?>
                                        <option value="<?php echo $row->id; ?>" <?= ($row->id == $dosen_id)? 'selected':'' ?>><?php echo $row->nama_dosen; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= $dosen_nama ?>

                            <?php if(form_error('dosen_id')){ ?>
                                <label id="dosen_id-error" class="error" for="dosen_id"><?php echo form_error('dosen_id') ?></label>
                            <?php } ?>
                        </div>

                        <label for="nim">Mahasiswa</label>
                        <div class="form-group">
                            <div class="form-line" style="display:none;">
                                <select id="nim" name="nim" class="form-control show-tick <?php echo form_error('nim') ? 'error':'' ?>" required style="display:none;">
                                    <option value="">-- Please select --</option>
                                    <?php foreach ($mahasiswa as $row): ?>
                                        <?php if ($user_logged->role === '3' && $mahasiswa_id==$row->nim): ?>
                                            <option value="<?php echo $row->nim; ?>" <?php echo ($mahasiswa_id==$row->nim)? 'selected':''; ?>><?php echo $row->nama_mahasiswa; ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $row->nim; ?>"><?php echo $row->nama_mahasiswa; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= $mahasiswa_nama ?>

                            <?php if(form_error('nim')){ ?>
                                <label id="nim-error" class="error" for="nim"><?php echo form_error('nim') ?></label>
                            <?php } ?>
                        </div>

                        <label for="semester">Semester Mahasiswa</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" id="semester" name="semester" class="form-control <?php echo form_error('semester') ? 'error':'' ?>" placeholder="Masukkan semester" required>
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
    <!-- #END# Vertical Layout -->
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
