<?php
$success = '';
$ext = '';
$error = '';
$max_size = 1000024;
$allowed = array('PNG','jpg','gif');
 /* check input submit */
  if (isset($_POST['submit'])) {

    /* check input file_upload on error */
    if (isset($_FILES['image']['error'])) {

      /* check code error = 4 for validate 'no file' */         
      if ($_FILES['image']['error'] == 4) {

        $error = '<div class="col-6 alert alert-danger">File not selected</div>';

      }	elseif (isset($_POST["submit"])) {
	 	if (isset($_FILES["image"])) {
		 	if ($_FILES["image"]["size"] > $max_size) {
		 			$error = '<div class="col-6 alert alert-danger">File to big!!!</div>';
		 		} elseif ($_FILES["image"]) {
		 			$ext = explode(".", $_FILES["image"]["name"]);
		 			$exten = strtolower($ext[count($ext)-1]);
		 			if (isset($_POST['rename'])) {
		 				$text = ($_POST['rename']);
		 			} else {
		 				$text = ($_FILES["image"]["name"]);
		 			}
		 			if (in_array($exten, $allowed)) {
		 			move_uploaded_file($_FILES['image']['tmp_name'], "uploads/". $text .'.' . $exten);
		 			$error = '<div class="col-6 alert alert-success">File upoaded!</div>';
					 } else {
					 	$error = '<div class="col-6 alert alert-danger">Not supported file. Only JPG, PNG, GIF.</div>';
				 		}
	}
	} 
	}
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>upload</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container y">
		<div class="row">
			<div class="col-6 h text-center"><h1>Upload files</h1></div>
			<div class="col-6 sys"><pre><?php print_r($_FILES); ?></pre></div>
		</div>
		<div class="row">
			<div class="col-6 teip">
		      <form method="POST" enctype="multipart/form-data">Write new file name
		      		<input type="text" name="rename"></br>
				    <input type="file" name="image" >
				    <input type="submit" value="Upload Image" name="submit">
				</form>
     		 </div>
     		 <?php
     		
     		echo $error;
     		?>
		</div>
	</div>
</body>
</html>