<?php

$info = (object)[];

	$data = false;
	$data['userid'] = $DB->generate_id(20);
	$data['date'] = date("Y-m-d H:i:s");
	$data['level'] = $DATA_OBJ->level;

	if (empty( $DATA_OBJ->level)) {
		$Error .= "Please Fill in a valid student level. <br>";
	}else
	{
// the code will  make sure your name has more than 3 characters
		if (strlen( $DATA_OBJ->username) < 3 )
		 {
			$Error .= "student level most be at least 3 characters long. <br>";
		}

//validate username so that it should not be empty
	$data['username'] = $DATA_OBJ->username;

	if (empty( $DATA_OBJ->username)) {
		$Error .= "Please Fill in a valid user name. <br>";
	}else
	{
// the code will  make sure your name has more than 2 words
		if (strlen( $DATA_OBJ->username) < 2 )
		 {
			$Error .= "user name most be at least 3 characters long. <br>";
		}
// the code bellow will make sure all the entery of the name are in characters with no number or symbol
		if (!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->username))
		 {
			$Error .= "Please Fill in a valid user name. <br>";
		}
	}

	$data['email'] = $DATA_OBJ->email;

	if (empty( $DATA_OBJ->email)) {
		$Error .= "Please Fill in a valid email. <br>";
	}else
	{
// the code below will first check to see if the email has xters, the check for the @ symbol and then the .com ending
		if (!preg_match("/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/", $DATA_OBJ->email))
		 {
			$Error .= "Please Fill in a valid email. <br>";
		}
	}

	$data['password'] = $DATA_OBJ->password;
	$password = $DATA_OBJ->password2;
	
		if (empty( $DATA_OBJ->password)) {
		$Error .= "Please enter a valid . <br>";
	}else
	{
// the code will  make sure your password match and has more than 8 xters.
		if ( $DATA_OBJ->password !=  $DATA_OBJ->password2)
		 {
			$Error .= "password most match. <br>";
		}
		if (strlen( $DATA_OBJ->username) < 2 )
		 {
			$Error .= "password most be at least 8 characters long. <br>";
		}

}

	if($Error == "")
	{
		$query = "insert into users(userid,username,email,password,date,level) values(:userid,:username,:email,:password,:date,:level)";
		//error found
		$result = $DB->write($query,$data);

		if($result)
		{
			$info->message = "Your profile was created";
			$info->data_type = "info";
			echo json_encode($info);
			
		}else
		{
			$info->message = "Your profile was not created due to an error";
			$info->data_type = "error";
			echo json_encode($info);
		}
	}else
	{
		
		$info->message = $Error;
		$info->data_type = "error";
		echo json_encode($info);
		
	}
