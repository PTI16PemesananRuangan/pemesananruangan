
        <h2 style="margin-top:0px">Kampus Form</h2>
        <form action="<?php echo $action; ?>" method="post"  enctype="multipart/form-data"> 
	    <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
                <label for="description">Alamat <?php echo form_error('alamat') ?></label>
                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="alamat"><?php echo $alamat; ?></textarea>
            </div>
       
       
        <br>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_kampus') ?>" class="btn btn-default">Cancel</a>
	</form>
