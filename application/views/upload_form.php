<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Subir Archivo</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
<div class="container pt-5">
<br><br>
      <?php echo $error;?>
      <?php $id = $this->input->post("id");?>
    <div class="row mt-5">
        <div class="col-md-12 pt-5">
        <?php echo form_open_multipart('upload/do_upload/'.$id);?>
                    <label for="">Subir Imagen:</label>
                    <br>
                    <input type="file" name="userfile" size="20" />
                    
                    <span class="help-block">Seleccione archivo .jpg  y .png</span>

                    <br />

                <input type="submit" class="btn btn-info" value="Subir Archivo" />

                </form>
        </div>        
    </div>
</div>

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
