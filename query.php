<?php
	if(isset($_GET['names']))
	{
		$names = explode(',', $_GET['names']);
		foreach($names as $key=>$value)
		{
			echo($key.'=>'.$value);
		}
	}

	function getSteamProfile($name)
	{
	}
