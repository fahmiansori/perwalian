<?php $this->load->view('app/_template/1head.php'); ?>
<!-- HEAD HERE -->
<!-- #END HEAD HERE -->


<?php $this->load->view('app/_template/2topbar.php'); ?>


<?php $this->load->view('app/_template/3sidebar.php'); ?>


<?php $this->load->view('app/_template/4content.php'); ?>
<!-- CONTENT HERE -->
<?php
    $user = $this->session->userdata("user_logged");
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

  <!-- Striped Rows -->
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                      <?php
                          function tanggal_indo($tanggal)
                          {
                              $hari = array ( 1 =>    'Senin',
                                  'Selasa',
                                  'Rabu',
                                  'Kamis',
                                  'Jumat',
                                  'Sabtu',
                                  'Minggu'
                              );

                              $bulan = array (1 =>   'Januari',
                                  'Februari',
                                  'Maret',
                                  'April',
                                  'Mei',
                                  'Juni',
                                  'Juli',
                                  'Agustus',
                                  'September',
                                  'Oktober',
                                  'November',
                                  'Desember'
                              );
                              $tanggal_ = date('Y-m-d', strtotime($tanggal));
                              $split 	  = explode('-', $tanggal_);
                              $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

                              $num = date('N', strtotime($tanggal));
                              $jam = date('H:i', strtotime($tanggal));
                              return $jam.', '. $hari[$num] . ' ' . $tgl_indo;
                          }
                      ?>
                      <?= ucwords(implode(' ',explode('_',$this->uri->segment(1)))) ?> - <?= ucwords(implode(' ',explode('_',$this->uri->segment(2)))) ?>
                      <!-- <small>Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code></small> -->
                  </h2>
                  <ul class="header-dropdown m-r--5">
                      <li class="dropdown">
                          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i class="material-icons">more_vert</i>
                          </a>
                          <ul class="dropdown-menu pull-right">
                              <?php if (isset($user) && $user && $user->role === '1' || isset($user) && $user && $user->role === '2'): ?>
                                  <li><a href="<?php echo site_url('jadwal_perwalian/add') ?>">Add</a></li>
                              <?php endif; ?>
                          </ul>
                      </li>
                  </ul>
              </div>

              <div class="body table-responsive">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Jadwal</th>
                              <th>Nama Mahasiswa</th>
                              <th>Semester</th>
                              <th>Nama Dosen</th>
                              <th>Status</th>
                              <th>Isi Perwalian</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>

                      <tbody>
                          <?php
                            $no = (int) $page;
                            $data_result = $data->result();
                          ?>
                          <?php if($data_result):?>
                              <?php foreach ($data_result as $row): ?>
                                  <tr>
                                      <th scope="row"><?php echo ++$no; ?></th>
                                      <td>
                                          <!-- < ?php echo date('H:i, l d F Y',strtotime($row->waktu)) ?> -->
                                          <?php echo tanggal_indo($row->waktu) ?>
                                      </td>
                                      <td>
                                          <?php echo $row->nama_mahasiswa ?>
                                      </td>
                                      <td>
                                          <?php echo $row->semester ?>
                                      </td>
                                      <td>
                                          <?php echo $row->nama_dosen ?>
                                      </td>
                                      <td>
                                          <?php
                                          if ($row->status == 'waiting' && date('Y-m-d', strtotime($today)) > date('Y-m-d',strtotime($row->waktu))) {
                                              echo "<span class='label label-default'>Telah lewat</span>";

                                              $data_update = array(
                                                  'status' => 'expired',
                                              );
                                              $this->db->update('jadwal_perwalian', $data_update, array('id' => $row->id));
                                          }else {
                                              switch ($row->status) {
                                                  case 'waiting':
                                                  echo "<span class='label label-warning'>Menunggu</span>";
                                                  break;
                                                  case 'canceled':
                                                  echo "<span class='label label-danger'>Dibatalkan</span>";
                                                  break;
                                                  case 'expired':
                                                  echo "<span class='label label-default'>Telah lewat</span>";
                                                  break;
                                                  case 'onprocess':
                                                  echo "<span class='label label-info'>Sedang berlangsung</span>";
                                                  break;
                                                  case 'done':
                                                  echo "<span class='label label-success'>Selesai</span>";
                                                  break;

                                                  default:
                                                  echo "-";
                                                  break;
                                              }
                                          }
                                          ?>
                                      </td>
                                      <td>
                                          <?php echo $row->isi_perwalian ?>
                                      </td>
                                      <td>
                                          <?php if (isset($user) && $user && $user->role === '1' || isset($user) && $user && $user->role === '2'): ?>
                                              <?php if(date('Y-m-d', strtotime($today)) <= date('Y-m-d',strtotime($row->waktu)) && $row->status == 'waiting'):?>
                                                  <a href="<?php echo site_url('jadwal_perwalian/batalkan/'.$row->id.'/'.$this->uri->segment(2)) ?>"
                                                      class="btn btn-small text-warning"><i class="material-icons">stop</i> Batalkan
                                                  </a>

                                                  <?php if(date('Y-m-d', strtotime($today)) == date('Y-m-d',strtotime($row->waktu)) && $row->status == 'waiting'):?>
                                                      <a href="<?php echo site_url('jadwal_perwalian/bimbingan/'.$row->id) ?>"
                                                          class="btn btn-small text-info"><i class="material-icons">skip_next</i> Sedang bimbingan
                                                      </a>
                                                  <?php endif;?>

                                                  <a href="<?php echo site_url('jadwal_perwalian/edit/'.$row->id) ?>"
                                                      class="btn btn-small"><i class="material-icons">gesture</i> Edit
                                                  </a>

                                                  <?php if (isset($user) && $user && $user->role === '1'): ?>
                                                      <a onclick="deleteConfirm('<?php echo site_url('jadwal_perwalian/delete/'.$row->id) ?>')"
                                                          href="#!" class="btn btn-small text-danger"><i class="material-icons">delete_forever</i> Hapus
                                                      </a>
                                                  <?php endif; ?>
                                              <?php endif;?>

                                              <?php if($row->status == 'onprocess'):?>
                                                  <a href="<?php echo site_url('jadwal_perwalian/selesaikan/'.$row->id) ?>"
                                                      class="btn btn-small text-success"><i class="material-icons">check</i> Selesai
                                                  </a>
                                              <?php endif;?>

                                              <?php if($row->status == 'done'):?>
                                                  <a href="<?php echo site_url('jadwal_perwalian/editisi/'.$row->id) ?>"
                                                      class="btn btn-small text-success"><i class="material-icons">gesture</i> Edit Isi
                                                  </a>
                                              <?php endif;?>
                                          <?php endif; ?>

                                          <?php if (date('Y-m-d', strtotime($today)) <= date('Y-m-d',strtotime($row->waktu)) && isset($user) && $user && $user->role === '3'): ?>
                                              <?php if ($row->status == 'waiting'): ?>
                                                  <a href="<?php echo site_url('jadwal_perwalian/form_uraian/'.$row->id) ?>" class="btn btn-small text-success">
                                                      <i class="material-icons">print</i> Isi uraian
                                                  </a>
                                              <?php endif; ?>
                                          <?php endif; ?>

                                          <a href="<?php echo site_url('jadwal_perwalian/form_perwalian/'.$row->id) ?>" class="btn btn-small text-success"><i class="material-icons">print</i> Print
                                          </a>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>
                          <?php else:?>
                              <tr>
                                  <td colspan="7" class="text-center">Belum ada data!</td>
                              </tr>
                          <?php endif;?>
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
