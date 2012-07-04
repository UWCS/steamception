<html>
	<head>

		<link rel="stylesheet" type="text/css" href="main.css" />

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> 
<script type="text/javascript">
people = [];

updateLink = function(){
	if (people.length > 1){
		$('#compare').html('Compare!');
		$('#compare').attr('onClick','getGames(\''+people.join(',')+'\');');
	}
	else{
		$('#compare').html('');
		$('#compare').attr('onClick','');
	}
}

removePerson = function(person){
	$('.person[person="'+person+'"]').remove();
	people.splice($.inArray(person, people), 1);
	updateLink();
}

addPerson = function(person){
	if(person){
		if (-1 == jQuery.inArray(person, people)){
			people.push(person);

			$('#people').append('\
				<div class="person" person='+person+'><a class="name">'+person+'</a>\
				<a href="#" onClick="removePerson(\''+person+'\')"><img src="images/remove.png" /></a>\
				</div>\
			');

			if(/[0-9]{17}/.test(person))
			{
				$('.person[person="'+person+'"] .name').attr('href','http://steamcommunity.com/profiles/'+person);
			}
			else
			{
				$('.person[person="'+person+'"] .name').attr('href','http://steamcommunity.com/id/'+person);
			}

			updateLink(person);
			return true;
		} else {
			$('#errors').append('Already added<br />');
		}
	} else {
		$('#errors').append('Empty!<br />');
	}
	return false;
}

addFromField = function(){
	value = $('#addperson').attr('value');
	if(addPerson(value))
	{
		$('#addperson').attr('value', '');
	}
	return false;
}

getGames = function(link){
	$('#results').html('');
	fetchPath = 'query.php?names='+link;
	var jqxhr = $.getJSON(fetchPath, function(data) {
		$.each(data, function(key, val){
			linkBase = 'http://store.steampowered.com/app/';
			imgBase = 'http://cdn.steampowered.com/v/gfx/apps/';
			imgEnd = '/header_292x136.jpg';
			$('#results').append('\
				<div class="post">\
					<div class="icon">\
						<a href="'+linkBase+key+'">\
							<img src="'+imgBase+key+imgEnd+'" alt="'+val+'"/>\
						</a>\
					</div>\
					<div class="info">\
						<div class="text">\
							<h3>' + val + '</h3>\
						</div>\
					</div>\
				</div>\
			');
		});
	}).error(function(jqXHR, textStatus, errorThrown) {
		$('#errors').append('There was a problem, try again!<br />');
		console.log("error " + textStatus);
		console.log("incoming Text " + jqXHR.responseText);
	});
	return false;
}

$(document).ready(function()
			{
				$('#addbutton').click(addFromField);
				$('#addform').submit(addFromField);
				$('#removeperson').click(removePerson);
<?php
	if(isset($_GET['names']))
	{
		$names = explode(',', $_GET['names']);
		foreach($names as $key=>$value)
		{
			echo('addPerson("'.$value.'");');
		}
	}
	if(isset($_GET['compare']))
	{
		echo('getGames(people.join(\',\'));');
	}
?>
			});
</script>

	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="logo">
					<a href=""><img src="images/logo.png" alt="University of Warwick Computing Society" /></a>
				</div>
			</div>
			<div id="page">
				<div id="sidebar">
					<form id="addform">
						<input id="addperson" type="text"/>
						<a href="#" id="addbutton">
							<img src="images/add.png">
						</a>
					</form>
					<p><a href="#" id="compare"></a></p>
					<div id="people">
					</div>
					<div id="errors">
					</div>
				</div>
				<div id="content">
					<div id="results">
						<div class="post">
							<div class="info">
								<h3>
									Steam common game finder
								</h3>
								Add the Steam ids or usernames of yourself and your friends to the left:<br />
								You want the unique part of the url, for example:<br />
								http://steamcommunity.com/id/<b>zed0h</b><br />
								http://steamcommunity.com/profiles/<b>76561198034371475</b><br />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="footer-spacer">
			</div>
		</div>
		<div id="footer">
			Created by <a href="https://github.com/cranman">Matt Cranham</a> and <a href="https://github.com/zed0">Ben Falconer</a> for the <a href="http://uwcs.co.uk">Univeristy of Warwick Computing Society</a><br />
			<a href="https://github.com/UWCS/steamception">Source code is available.</a>
		</div>
	</body>
</html>
