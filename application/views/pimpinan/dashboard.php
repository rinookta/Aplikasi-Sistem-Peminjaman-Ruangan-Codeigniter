<?php $this->load->view('pimpinan/componen/head'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
   	  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $this->M_pimpinan->jusers(); ?></h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $this->M_pimpinan->jpengajuan(); ?></h3>

              <p>Pengajuan</p>
            </div>
            <div class="icon">
              <i class="fa fa-external-link"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $this->M_pimpinan->jruangan(); ?></h3>

              <p>Ruangan</p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
      	<div class="col-lg-12">
      	<div class="box box-info">
          	<div class="box-body">
          	  <div class="table-responsive">
                <table class="table no-margin example">
                  <thead>
                  <tr>
                    <th>Ruangan</th>
                    <th>Status</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $ruangan= $this->M_pimpinan->ruangan(); $vr=1; foreach($ruangan as $hruangan){ $cekpeng= $this->M_pimpinan->cekpengajuan($hruangan->c_ruangan); ?>
                  <tr>
                      <td><?php echo $hruangan->ruangan; ?></td>
                      <?php
	                  if(!empty($cekpeng)){ foreach($cekpeng as $hcekpeng);
	                    if($hcekpeng->status=='reject' or $hcekpeng->status=='batal'){
	                      echo '<td>Tidak Terpakai</td>';
	                      echo '<td>-</td>';
	                      echo '<td>-</td>';
	                    }
	                    else if($hcekpeng->status=='pending' or $hcekpeng->status==''){
	                      echo '<td><span class="label label-success">Dalam Pengajuan</span></td>';
	                      echo '<td>'.date('d-m-Y H:i',strtotime($hcekpeng->mulai)).'</td>';
	                      echo '<td>'.date('d-m-Y H:i',strtotime($hcekpeng->selesai)).'</td>';
	                    }
	                    else if($hcekpeng->status=='approve'){
	                      echo '<td><span class="label label-primary">Terpakai</span></td>';
	                      echo '<td>'.date('d-m-Y H:i',strtotime($hcekpeng->mulai)).'</td>';
	                      echo '<td>'.date('d-m-Y H:i',strtotime($hcekpeng->selesai)).'</td>';
	                    }
	                  }
	                  else{
	                    echo '<td>Tidak Terpakai</td>';
	                    echo '<td>-</td>';
	                    echo '<td>-</td>';
	                  }?>
                  </tr>
                  <?php $vr++; } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
          	</div>
          </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<?php $this->load->view('pimpinan/componen/foot'); ?>
