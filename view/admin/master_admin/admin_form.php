
        <h2 style="margin-top:0px">Admin <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	        <div class="form-group">
                <label for="varchar">Username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $username; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Name <?php echo form_error('name') ?></label>
                <input type="text" class="form-control" name="name" id="name" placeholder="name" value="<?php echo $name; ?>" />
            </div>
	        <div class="form-group">
                <label for="varchar">Email <?php echo form_error('email') ?></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
            </div>
	        <div class="form-group">
                <label for="varchar">Password <?php echo form_error('password') ?></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Password Confirmation <?php echo form_error('passconf') ?></label>
                <input type="password" class="form-control" name="passconf" id="passconf" placeholder="password confirmation" value="<?php echo $password; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_admin') ?>" class="btn btn-default">Cancel</a>
	</form>
