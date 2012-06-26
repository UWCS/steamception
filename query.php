<?php
	if(isset($_GET['names']))
	{
		$names = explode(',', $_GET['names']);
		foreach($names as $key=>$value)
		{
			$user[$value] = getSteamProfile($value);
		}

		$intersection = call_user_func_array(array_intersect, $user);

		generateXML($intersection);
	}

	function getSteamProfile($name)
	{
		$HEAD_URL = 'http://steamcommunity.com/id/';
		$TAIL_URL = '/games?tab=all&xml=1';
		$xml = simplexml_load_file($HEAD_URL.$name.$TAIL_URL) or die('Error loading XML data.');

		foreach($xml->games->game as $game)
		{
			$games[(string) $game->appID] = (string)$game->name;
		}

		return $games;
	}

	function generateXML($intersection)
	{
		$out = new SimpleXMLElement('<xml/>');

		foreach($intersection as $key=>$value)
		{
			$game = $out->addChild('game');
			$game->addChild('name', $value);
			$game->addChild('id', $key);
		}

		print($out->asXML());
	}
