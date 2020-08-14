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

  <!-- Striped Rows -->
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                      <?= ucfirst($this->uri->segment(1)) ?>
                      <!-- <small>Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code></small> -->
                  </h2>
                  <ul class="header-dropdown m-r--5">
                      <li class="dropdown">
                          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i class="material-icons">more_vert</i>
                          </a>
                          <ul class="dropdown-menu pull-right">
                              <li><a href="<?php echo site_url('dosen/add') ?>">Add</a></li>
                          </ul>
                      </li>
                  </ul>
              </div>

              <div class="body table-responsive">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>NIP</th>
                              <th>Nama</th>
                              <th>Alamat</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>

                      <tbody>
                          <?php
                            $no = (int) $page;
                          ?>
                        <?php foreach ($data->result() as $row): ?>
                          <tr>
                            <th scope="row"><?php echo ++$no; ?></th>
                            <td>
                              <?php echo $row->nip ?>
                            </td>
                            <td>
                              <?php echo $row->nama_dosen ?>
                            </td>
                            <td>
                              <?php echo $row->alamat_dosen ?>
                            </td>
                            <td>
                              <a href="<?php echo site_url('dosen/edit/'.$row->id) ?>"
                                class="btn btn-small"><i class="material-icons">gesture</i> Edit
                              </a>
                              <a onclick="deleteConfirm('<?php echo site_url('dosen/delete/'.$row->id) ?>')"
                                href="#!" class="btn btn-small text-danger"><i class="material-icons">delete_forever</i> Hapus
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>

              <div class="row">
                  <div class="col">
                      <!--Tampilkan pagination-->
                      <?php echo $pagination; ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- #END# Striped Rows -->
</div>

<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- #END CONTENT HERE -->


<?php $this->load->view('app/_template/5js.php'); ?>
<!-- JS HERE -->
<script>
function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>
<!-- #END JS HERE -->


<?php $this->load->view('app/_template/6end.php'); ?>
