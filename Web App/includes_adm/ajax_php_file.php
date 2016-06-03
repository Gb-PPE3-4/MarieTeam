<?php
	if(isset($_FILES["input_image"]["type"]))
	{
		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["input_image"]["name"]);
		$file_extension = end($temporary);
		if ((($_FILES["input_image"]["type"] == "image/png") || ($_FILES["input_image"]["type"] == "image/jpg") || ($_FILES["input_image"]["type"] == "image/jpeg")
		) //&& ($_FILES["input_image"]["size"] < 100000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) 
		{
			if ($_FILES["input_image"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["input_image"]["error"] . "<br/><br/>";
			}
			else
			{
				if (file_exists("upload/" . $_FILES["input_image"]["name"])) 
				{
					echo $_FILES["input_image"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
				}
				else
				{
					$sourcePath = $_FILES['input_image']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "../images/".$_FILES['input_image']['name']; // Target path where file is to be stored
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					echo "<span id='success'>Upload d'Image Réussi...!!</span><br/>";
					echo "<br/><b>Nom du fichier:</b> " . $_FILES["input_image"]["name"] . "<br>";
					echo "<b>Type:</b> " . $_FILES["input_image"]["type"] . "<br>";
					echo "<b>Taille:</b> " . ($_FILES["input_image"]["size"] / 1024) . " kB<br>";
				}
			}
		}
		else
		{
			echo "<span id='invalid'>***Invalid file Size or Type***<span>";
		}
	}
?>