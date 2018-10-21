<html>
   <body>
      <?php
         echo Form::open(array('url' => '/uploadfile','files'=>'true'));
         echo 'Select the file to upload.';
         #define the file name
         echo Form::file('image');
         echo Form::submit('Upload File');
         echo Form::close();
      ?>
   </body>
</html>