

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Invoice Masuk
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <?php if($this->session->flashdata('sukses')){ ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p><center><?php echo $this->session->flashdata('sukses'); ?></center></p>
              </div>
            <?php }?>
            <?php if($this->session->flashdata('gagal')){ ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p><center><?php echo $this->session->flashdata('gagal'); ?></center></p>
              </div>
            <?php }?>
            <div class="box-body">
              <table id="mytable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th width="10%">Bukti Transfer</th>
                    <th>Email User</th>
                    <th>Bank Tujuan</th>
                    <th>Jumlah Transfer</th>
                    <th>Atas Nama</th>
                    <th width="7%">Status</th>
                    <th width="7%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql     = "SELECT * FROM abe_invoice ORDER BY (CASE WHEN status = 'transfer' THEN 0 WHEN status = 'belum bayar' THEN 1 ELSE 2 END), id_invoice DESC";
                    $invoice = $this->db->query($sql)->result();
                    $no = 1;
                    foreach ($invoice as $row) {
                        $id_invoice = $row->id_invoice;
                        $id = $row->id_user;
                        $user = $this->db->query("SELECT * FROM users WHERE id = '$id'")->row_array();
                        $a = !empty($user['email']) ? $user['email'] : 'User #' . $id;
                        $b = $row->file_foto;
                        $img_src = get_foto_transfer($b);
                        
                        if ($row->status == 'transfer') {
                            $status_badge = "<span class='label label-warning'><i class='fa fa-clock-o'></i> Menunggu Validasi</span>";
                            $btn_action   = "<a title='Konfirmasi Lunas' class='btn btn-xs btn-success btn-flat' href='".base_url()."back_end/deposit/konfirmasi_invoice/$id_invoice'><i class='fa fa-check'></i> Konfirmasi Lunas</a>";
                        } elseif ($row->status == 'lunas') {
                            $status_badge = "<span class='label label-success'><i class='fa fa-check-circle'></i> Lunas</span>";
                            $btn_action   = "<span class='badge bg-green'><i class='fa fa-check'></i> Selesai</span>";
                        } else {
                            $status_badge = "<span class='label label-default'>$row->status</span>";
                            $btn_action   = "<span class='text-muted'>Menunggu Pembayaran</span>";
                        }
                        
                        echo "<tr>
                            <td>$no</td>
                            <td><a href='$img_src' target='_blank'><img src='$img_src' style='height:60px; max-width:90px; object-fit:cover; border-radius:4px;' class='img-thumbnail'></a></td>
                            <td><strong>$a</strong><br><small class='text-muted'>$row->no_invoice</small></td>
                            <td>$row->bank_penerima</td>
                            <td><strong>Rp ".number_format($row->jumlah_transfer,2,',','.')."</strong></td>
                            <td>$row->nama_pengirim</td>
                            <td>$status_badge</td>
                            <td>$btn_action</td></tr>";
                          $no++;
                      }
                  ?>
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      format: "dd-mm-yyyy",
      autoclose: true
    })
  })
</script>
<!-- page script -->
<script>
  $(function () {
    $('#mytable').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
