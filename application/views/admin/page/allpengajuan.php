<?php $this->load->view('admin/componen/head'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-external-link"></i> Semua Data Pengajuan</h3>
                <span class="pull-right"><a class="btn btn-xs bg-blue" target="_blank" href="<?php echo base_url('admin/export/allpengajuan'); ?>"><i class="fa fa-print"></i> Export</a></span>
			</div>
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped example">
                <thead>
	                <tr class="text-center">
	                  <th width="5%">NO</th>
	                  <th>HARI</th>
	                  <th>MULAI</th>
	                  <th>SELESAI</th>
	                  <th>RUANGAN</th>
	                  <th>KEPERLUAN</th>
	                  <th>PEMINJAM</th>
	                  <th>STATUS</th>
	                </tr>
                </thead>
                <tbody>
                	<?php $allpeng= $this->M_admin->allpengajuan(); $vr=1; foreach($allpeng as $hallpeng){ ?>
                	<tr>
                		<td><?php echo $vr; ?></td>
                		<?php if($hallpeng->status=='reject'){
                            echo '<td style="background-color: #d33724;color:#fff;">'.hari($hallpeng->mulai).'</td>';
                        } else if($hallpeng->status=='pending'){
                            echo '<td style="background-color: #00a65a;color:#fff;">'.hari($hallpeng->mulai).'</td>';
                        } else if($hallpeng->status=='approve'){
                            echo '<td style="background-color: #005384;color:#fff;">'.hari($hallpeng->mulai).'</td>';
                        } else if($hallpeng->status=='batal'){
                            echo '<td>'.hari($hallpeng->mulai).'</td>';
                        } else{
                            echo '<td>'.hari($hallpeng->mulai).'</td>';
                        }?>
                		<td><?php echo date('d-m-Y H:i:s',strtotime($hallpeng->mulai)); ?></td>
                		<td><?php echo date('d-m-Y H:i:s',strtotime($hallpeng->selesai)); ?></td>
                		<td><?php echo $hallpeng->ruangan; ?></td>
                		<td><?php echo $hallpeng->keperluan; ?></td>
                		<td><?php echo $hallpeng->peminjam; ?></td>
                		<td><?php if($hallpeng->status=='reject'){echo '<span class="badge bg-red">Reject</span>';} else if($hallpeng->status=='pending'){echo '<span class="badge bg-green">Pending...</span>';} else if($hallpeng->status=='approve'){echo '<span class="badge bg-blue">Approve</span>';} else if($hallpeng->status=='batal'){echo '<span class="badge bg-navy">Dibatalkan</span>';} else{echo '<span class="badge bg-grey">NO Respon</span>';}?></td>
                	</tr>
                	<?php $vr++; } ?>
                </tbody>
            	</table>
			</div>
		</div>
    </section>
    <!-- /.content -->
</div>
<?php $this->load->view('admin/componen/foot'); ?>
