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

doAddPerson = function(){
	value = $('#addperson').attr('value')
	if(value){
		if (-1 == jQuery.inArray(value, people)){
			people.push(value);

			$('#people').append('\
				<div class="person" person='+value+'>\
					'+value+'<a href="#" onClick="removePerson(\''+value+'\')"><img src="images/remove.png" /></a>\
				</div>\
			');

			updateLink(value);
		} else {
			$('#errors').append('Already added<br />');
		}
	} else {
		$('#errors').append('Empty!<br />');
	}
	$('#addperson').attr('value', '')

	return false;
}

getGames = function(link){
	$('#results').html('');
	fetchPath = 'query.php?names='+link;
	var jqxhr = $.getJSON(fetchPath, function(data) {
		console.log(data);
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
				$('#addbutton').click(doAddPerson);
				$('#addform').submit(doAddPerson);
				$('#removeperson').click(removePerson);
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
					</div>
				</div>
			</div>
			<div id="footer-spacer">
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html>
