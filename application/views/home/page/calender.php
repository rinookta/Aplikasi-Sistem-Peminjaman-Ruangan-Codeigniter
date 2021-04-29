<?php $this->load->view('home/componen/head'); ?>
<script src='<?php echo base_url(); ?>theme/calender/lib/moment.min.js'></script>
<script src='<?php echo base_url(); ?>theme/calender/lib/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>theme/calender/fullcalendar.min.js'></script>
<script type="text/javascript">
	$(document).ready(function() {
    $("#keterangan").modal('show');
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Hari Ini',
        month: 'Bulan',
        week : 'Minggu',
        day  : 'Hari'
      },
      timeFormat: 'H(:mm)',
      defaultDate: '<?php echo date('Y-m-d H:i:s'); ?>',
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: [
        <?php $allpeng= $this->M_home->allpengajuan(); $vr=1; foreach($allpeng as $hallpeng){
        if($hallpeng->status=='reject'){
        	$war= '#d33724';
        } else if($hallpeng->status=='pending'){
        	$war= '#00a65a';
        } else if($hallpeng->status=='approve'){
        	$war= '#005384';
        } else if($hallpeng->status=='batal'){
        	$war= '#001f3f';
        } else{
        	$war= '#30bbbb';
        }?>
        {
          title: '<?php echo $hallpeng->ruangan; ?>',
          start: '<?php echo $hallpeng->mulai; ?>',
          end: '<?php echo $hallpeng->selesai; ?>',
          backgroundColor: '<?php echo $war; ?>',
          borderColor    : '<?php echo $war; ?>'
        },
        <?php } ?>
      ]
    });

  });
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
    	<div class="box box-primary">
    		<div class="box-body table-responsive">
    			<div id='calendar'></div>
    		</div>
    	</div>
    </section>
    <!-- /.content -->
  </div>
<div id="keterangan" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header bg-green">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"><i class="fa fa-info"></i> Keterangan Calender</h4>
        </div>
          <div class="modal-body">
            <p><i class="fa fa-stop" style="color:#005384;"></i> Approve</p>
            <p><i class="fa fa-stop" style="color:#00a65a;"></i> Pending</p>
            <p><i class="fa fa-stop" style="color:#d33724;"></i> Reject</p>
            <p><i class="fa fa-stop" style="color:#001f3f;"></i> Batal</p>
            <p><i class="fa fa-stop" style="color:#30bbbb;"></i> No Respon</p>
          </div>     
        <div class="modal-footer"> 
          <a class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('home/componen/foot'); ?>
