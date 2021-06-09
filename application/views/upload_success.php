<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Archivo Cargado</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Tu Archivo fue cargado Correctamente</h3>
                <ul>
                    <?php foreach ($upload_data as $item => $value):?>
                        <li><?php echo $item;?>: <?php echo $value;?></li>
                    <?php endforeach; ?>
                </ul>
                    <p><?php echo anchor('upload', 'Deseas cargar otro archivo?'); ?></p>
                    <br>
                    <a href="<?php echo base_url();?>equipos/computadoras" class="btn btn-primary btn-flat"><span class="fas fa-arrow-left"></span>Volver</a>
        </div>        
    </div>
    <?php 
        for($i = 0; $i < 6; $i++ )
            { echo "<br />";}   
    ?>

    <center>
        <img src="<?php echo $img?>">
    </center>
    
</div>

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>