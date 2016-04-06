
    <h2 style="margin-top:0px">Ruangan Detail</h2>
    <table class="table">
	    <tr><td>Nama Ruangan</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>kapasitas</td><td><?php echo $kapasitas; ?></td></tr>
	    <tr><td>Fasilitas</td><td><?php echo $fasilitas; ?></td></tr>
	     <tr><td>Kampus</td><td><?php  echo form_dropdown('id_kampus' , $kampus_options,$id_kampus,' class="form-control" disabled '); ?></td></tr>
	    <tr>
	    	<td>product Image</td>
	    	<?php 
	    		if (!empty($foto)) {
	    			# code...
	    	?>
	    		<td> <img src="<?php echo base_url('upload/'.$foto.'') ?>" class="img-thumbnail" alt="Cinque Terre"></td>
	    	<?php
	    		}

	    	 ?>
	    	
	    </tr>
	    <tr><td></td><td><a href="<?php echo site_url('master_ruang') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
