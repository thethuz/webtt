<html>
<head>
   <style type="text/css">
   p  {
     color: red;
     font-family: courier;
     font-size: 160%;
     }
   </style>
</head>
<body style="background-color:orange">

   <?php
   echo Form::open(array('url' => 'foo/bar'));
   echo Form::text('username','Username');
   echo '<br/>';

   echo Form::text('email', 'example@gmail.com');
   echo '<br/>';

   echo Form::password('password');
   echo '<br/>';

   echo Form::checkbox('name', 'value');
   echo '<br/>';

   echo Form::radio('name', 'value');
   echo '<br/>';

   echo Form::file('image');
   echo '<br/>';

   echo Form::select('size', array('L' => 'Lare', 'S' => 'Small'));
   echo '<br/>';

   echo Form::submit('Click Me!');
   echo "<p>sf</p>";
   echo Form::close();
   ?>

</body>
</html>