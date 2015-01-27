<html>
<head>
<title>labouchere roulette system</title>
<script type="text/javascript">
var high_value ;
var seq_interval ; 
var spin = 0 ; 

function do_sequence() { 
	seq_interval = parseFloat( document.getElementById('sequence-interval').value ) ; 

	var how_much = parseFloat( document.getElementById('how-much').value ) ; 
	var put = 0 ; 
	var sequence = '' ; 
	var i = 0 ; 
	while( how_much > 0 ) {
		i++ ;
		put = parseFloat( i * seq_interval ).toFixed(2) ; 
		if( ( how_much - put ) < 0 ) { 
			put = how_much.toFixed(2) ; 
		}
		how_much -= put ; 
		sequence += put + ', ' ;
		high_value = put ; 
	}
	document.getElementById('sequence-stream').innerHTML = 
	document.getElementById('my-sequence').innerHTML = sequence ; 
	document.getElementById('next-bet').innerHTML = next_bet() ; 
}

function win() { 
	var sequence = document.getElementById('sequence-stream').innerHTML ; 
	var nb = sequence.split(', ') ; 
	new_sequence = '' ; 
	if( nb.length > 1 ) {
		nb.splice(0, 1);
		nb.splice((nb.length-2), 1);
		new_sequence = nb.join(', ') ; 
	}
	document.getElementById('sequence-stream').innerHTML = new_sequence ; 
	document.getElementById('next-bet').innerHTML = next_bet() ; 
	spins() ; 
}

function lose() { 
	var nextb = document.getElementById('next-bet') ; 
	document.getElementById('sequence-stream').innerHTML += nextb.innerHTML + ', ' ; 
	nextb.innerHTML = next_bet() ; 
	spins() ; 
}

function next_bet() { 
	var sequence = document.getElementById('sequence-stream').innerHTML ;
	var nb = sequence.split(', ') ; 
	if( nb.length <= 2 ) { 
		return nb[0] ; 
	} else if( nb.length > 1 ) {
		var first = parseFloat( nb[0] ) ; 
		var last = parseFloat( nb[(nb.length-2)] ) ; 
		return parseFloat(first+last).toFixed(2) ;
	}
	return 0 ; 
}

function spins() { 
	spin++ ; 
	document.getElementById('spins').innerHTML = spin ; 
}
</script>
<style>
.div-o{font-size:16px;font-weight:bold;padding:4px;border:solid 1px #E0E0E0;}
</style>
</head>
<body>

<table>
<tr>
	<td>How much do you wanna win?</td>
	<td><input type="text" id="how-much" name="how_much" value="1"></td>
</tr>
<tr>
	<td>Define the arithmetic interval:</td>
	<td><input type="text" id="sequence-interval" name="sequence_interval" onBlur="javascript:do_sequence()" value="0.2"></td>
</tr>
<tr>
	<td colspan="2">
		<div id="my-sequence" class="div-o"></div>
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
		<input type="button" name="go" value="Go!" onClick="javascript:do_sequence();">
		<br><br>
	</td>
</tr>
<tr>
	<td colspan="2">
		<b>next bet:</b>
		<div id="next-bet" style="float:right;" class="div-o"></div><br><br>
	</td>
</tr>
<tr>
	<td colspan="2">
		<b>spins:</b>
		<div id="spins" style="float:right;" class="div-o"></div><br><br>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="button" onClick="javascript:win();" style="font-size:16px;" value="I Win">
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" onClick="javascript:lose();" style="font-size:16px;" value="I Lose">
		<br><br>
	</td>
</tr>
<tr>
	<td colspan="2">
		<div id="sequence-stream" class="div-o"></div>
	</td>
</tr>
</table>

</body>
</html>