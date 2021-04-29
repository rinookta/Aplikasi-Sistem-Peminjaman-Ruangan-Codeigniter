<?php $this->load->view('users/componen/head'); ?>
<?php $c_users= $this->session->userdata('c_users'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $this->M_users->jpengajuan($c_users); ?></h3>

              <p>Pengajuan</p>
            </div>
            <div class="icon">
              <i class="fa fa-external-link"></i>
            </div>
            <a href="<?php echo base_url('users/pengajuansaya'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $this->M_users->jnotif($c_users); ?></h3>

              <p>Notifikasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-bell"></i>
            </div>
            <a href="<?php echo base_url('users/notifikasi'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-9 col-xs-12">
          <div class="box box-info">
          	<div class="box-body">
          	  <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Ruangan</th>
                    <th>Status</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $ruangan= $this->M_users->ruangan(); $vr=1; foreach($ruangan as $hruangan){ $cekpeng= $this->M_users->cekpengajuan($hruangan->c_ruangan); ?>
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
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php $this->load->view('users/componen/foot'); ?>
