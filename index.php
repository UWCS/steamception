<html>
	<head>

		<link rel="stylesheet" type="text/css" href="main.css" />

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> 
<script type="text/javascript">
people = [];
function updateLink(){
	if (people.length > 1){
		$('#compare').html('Compare!');
		$('#compare').attr('onClick','getGames(\''+people.join(',')+'\');');
	}
	$('#people').html(people.join(', '));
}

doAddPerson = function(){
	value = $('#addperson').attr('value')
		if(value){
			if (-1 == jQuery.inArray(value, people)){
				people.push(value);
				updateLink();
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
	fetchPath = 'query.php?names='+link;
	$.getJSON(fetchPath, function(data) {
		console.log(data);
		$.each(data, function(key, val){
			linkBase = 'http://store.steampowered.com/app/';
			imgBase = 'http://cdn.steampowered.com/v/gfx/apps/';
			imgEnd = '/header_292x136.jpg';
			$('#results').append('<div class="result"><a href="'+linkBase+key+'"><img src="'+imgBase+key+imgEnd+'" alt="'+val+'"/></a></div>');
		});
	});
	return false;
}

$(document).ready(function()
			{
				$('#addbutton').click(doAddPerson);
				$('#addform').submit(doAddPerson);
			});
</script>

	</head>
	<body>

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
		<div id="results">
		</div>

	</body>
</html>
