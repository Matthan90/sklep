<?php
	
	if (!isset($_SESSION['successfulRegistration']))
	{
		header('Location: ../../index.php');
		exit();
	}
	else
	{
		unset($_SESSION['successfulRegistration']);
	}
	
	if (isset($_SESSION['fr_name'])) unset($_SESSION['fr_name']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_password1'])) unset($_SESSION['fr_password1']);
	if (isset($_SESSION['fr_password2'])) unset($_SESSION['fr_password2']);
	
	if (isset($_SESSION['e_name'])) unset($_SESSION['e_name']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_password'])) unset($_SESSION['e_password']);
	if (isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);
	
