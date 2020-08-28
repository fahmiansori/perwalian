<?php $this->load->view('app/_template/1head.php'); ?>
<!-- HEAD HERE -->
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
                        Pengajuan Perwalian Mahasiswa
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
                        <input type="hidden" id="nim" name="nim" value="<?= $mahasiswa_id ?>" required>
                        <input type="hidden" id="dosen_id" name="dosen_id" value="<?= $dosen_id ?>" required>

                        <label for="waktu">Waktu</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="waktu" name="waktu" class="form-control datetimepicker <?php echo form_error('waktu') ? 'error':'' ?>" placeholder="Masukkan Waktu" required>
                            </div>

                            <?php if(form_error('waktu')){ ?>
                                <label id="waktu-error" class="error" for="waktu"><?php echo form_error('waktu') ?></label>
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

                        <div class="" id="container_element">
                            <?php
                                $index_form = 0;
                                $index_form++;
                                ?>
                                    <div class="items" id="div-<?= $index_form ?>">
                                        <label for="jenis-<?= $index_form ?>">Jenis</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="jenis-<?= $index_form ?>" name="jenis[]" class="form-control <?php echo form_error('jenis') ? 'error':'' ?>" placeholder="Masukkan jenis perwalian" required>
                                            </div>

                                            <?php if(form_error('jenis')){ ?>
                                                <label id="jenis-error" class="error" for="jenis-<?= $index_form ?>"><?php echo form_error('jenis') ?></label>
                                            <?php } ?>
                                        </div>

                                        <label for="uraian-<?= $index_form ?>">Uraian</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea id="uraian-<?= $index_form ?>" name="uraian[]" class="form-control <?php echo form_error('uraian') ? 'error':'' ?>" placeholder="Masukkan uraian perwalian" required rows="8" cols="80"><?php echo ''; ?></textarea>
                                            </div>

                                            <?php if(form_error('uraian')){ ?>
                                                <label id="uraian-error" class="error" for="uraian-<?= $index_form ?>"><?php echo form_error('uraian') ?></label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php
                            ?>
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-success btn-sm" id="add_item" name="" title="Tambah uraian">
                                <i class="material-icons">playlist_add</i>
                            </button>
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

<div class="" id="element_base" style="display:none;">
    <div class="items" id="div-###">
        <label>###.</label> <br>
        <label for="jenis-###">Jenis</label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" id="jenis-###" name="jenis[]" class="form-control" placeholder="Masukkan jenis perwalian" required>
            </div>
        </div>

        <label for="uraian-###">Uraian</label>
        <div class="form-group">
            <div class="form-line">
                <textarea id="uraian-###" name="uraian[]" class="form-control" placeholder="Masukkan uraian perwalian" required rows="8" cols="80"></textarea>
            </div>
        </div>

        <div class="" id="div-remove-###" style="margin-bottom:5px;">
            <button type="button" name="" class="btn btn-sm btn-danger remove_element" id="remove-###" data-index="###">
                <i class="material-icons">remove</i>
            </button>
        </div>
    </div>
</div>

<?php $this->load->view('app/_template/5js.php'); ?>
<!-- JS HERE -->
<script src="<?php echo base_url('assets/plugins/momentjs/moment.js'); ?>"></script>
<script type="text/javascript">
    var index_temp = '<?= $index_form ?>';
    var index_form = parseInt(index_temp);

    function escapeRegExp(string) {
        return string.replace(/[.*+\-?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
    }

    function replaceAll(str, find, replace) {
        return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
    }

    $('#add_item').click(function(event) {
        var element = '';
        element += $('#element_base').html();
        index_form++;
        element = replaceAll(element, "###", index_form);

        $('#container_element').append(element);
    });

    $(document).on('click','.remove_element', function () {
        var index_ = $(this).data('index');
        $('#div-'+index_).remove();
    });
</script>

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
