<?php $this->load->view('home/componen/head'); ?>
<div class="content-wrapper">
    <section class="content">
    	<div class="box box-info">
          	<div class="box-body">
          	  <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                  	<th></th>
                    <th>Ruangan</th>
                    <th>Status</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $ruangan= $this->M_home->ruangan(); $vr=1; foreach($ruangan as $hruangan){ $cekpeng= $this->M_home->cekpengajuan($hruangan->c_ruangan); ?>
                  <tr>
                  	  <td><button class="btn btn-xs bg-navy" onclick="detail('<?php echo $hruangan->c_ruangan; ?>')"><i class="fa fa-search"></i></button></td>
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
    </section>
</div>
<script type="text/javascript">
	function tutup(){
      $('#modaldetail').modal('hide');
    }
    function detail(id){
      $.ajax({
        url : "<?php echo base_url(); ?>home/getruangan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('#ruangan').text(data.ruangan);
          $('#keterangan').text(data.keterangan);
          if(data.gambar==''){
            $('#gambar').html('<img class="img-thumbnail" width="90%" id="profile-pre" src="<?php echo base_url(); ?>theme/assets/img/df.jpg" alt="Gambar Ruangan"/>');
          }
          else{
            $('#gambar').html('<img class="img-thumbnail" style="width:50%;height:200px;" id="profile-pre" src="<?php echo base_url(); ?>'+data.gambar+'" alt="Gambar Ruangan"/>');
          }
          $('#modaldetail').modal('show');
        },
      });
    }
</script>
<div id="modaldetail" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-maroon">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title"><i class="fa fa-university"></i> Detail Ruangan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>RUANGAN</label>
            <p id="ruangan"></p>
            <label>KETERANGAN</label>
            <p id="keterangan"></p>
            <label>GAMBAR</label>
            <p id="gambar"></p>
          </div>
        </div>
        <div class="modal-footer"> 
          <button class="btn btn-default" onclick="tutup()">Tutup</button>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('home/componen/foot'); ?>