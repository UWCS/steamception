<html>
<head>

<link rel="stylesheet" type="text/css" href="main.css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> 
<script type="text/javascript">
people = [];
function updateLink(){
	if (people.length > 1){
		link = 'query.php?'+people.join(',');
		$('#compare').html('Compare!');
		$('#compare').attr('href', link);
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
		<img src="http://imperial.istic.net/static/icons/silk/add.png">
	</a>
</form>

<p><a href="" id="compare"></a></p>
<div id="people">
</div>
<div id="errors">
</div>

</body>
</html>
