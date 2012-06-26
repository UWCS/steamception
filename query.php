<?php
	if(isset($_GET['names']))
	{
		$names = explode(',', $_GET['names']);
		foreach($names as $key=>$value)
		{
			echo($key.'=>'.$value);
			getSteamProfile($value);
		}
	}

	function getSteamProfile($name)
	{
		$HEAD_URL = 'http://steamcommunity.com/id/';
		$TAIL_URL = '/games?tab=all&xml=1';
		$xml = simplexml_load_file($HEAD_URL.$name.$TAIL_URL) or die('Error loading XML data.');

		foreach($xml->games->game as $game)
		{
			echo($game->appID);
		}

	}
