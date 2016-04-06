
        <h2 style="margin-top:0px">Master Ruang Form</h2>
        <form action="<?php echo $action; ?>" method="post"  enctype="multipart/form-data"> 
	    <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">Kapasitas <?php echo form_error('kapasitas') ?></label>
                <input type="text" class="form-control" name="kapasitas" id="kapasitas" placeholder="kapasitas" value="<?php echo $kapasitas; ?>" />
            </div>
	    <div class="form-group">
                <label for="description">Fasilitas <?php echo form_error('fasilitas') ?></label>
                <textarea class="form-control" rows="3" name="fasilitas" id="fasilitas" placeholder="fasilitas"><?php echo $fasilitas; ?></textarea>
            </div>
        <div class="form-group">
                <label for="int">Kampus <?php echo form_error('id_kampus') ?></label>
                <!-- <input type="text" class="form-control" name="id_category" id="id_category" placeholder="id_category" value="<?php echo $id_category; ?>" /> -->
                  <?php echo form_dropdown('id_kampus' , $kampus_options,$id_kampus,' class="form-control" '); ?>
            </div>
       
          <div class="form-group">
                <label for="varchar">Foto <?php echo form_error('foto') ?></label>
                <input type="file"  name="foto" id="foto" />            
            </div>
         <div>
                
                <?php 
                    if (isset($foto) && $foto!='') {
                        ?>
                        <img src="<?php echo base_url('upload/'.$foto) ?>" class="img-thumbnail" alt="Cinque Terre" />
                        <?php
                    }
                 ?>
        </div>
        <br>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_ruang') ?>" class="btn btn-default">Cancel</a>
	</form>
