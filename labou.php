<html>
<head>
<title>labouchere roulette system</title>
<script type="text/javascript">
var high_value ;
var seq_interval ; 
var spin = 0 ; 
var total_wins = 0 ; 
var total_losses = 0 ; 
var winning_return = 1 ; 
var last_sequence ;
var total_bet = 0 ; 

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
	var winning_return = parseFloat( document.getElementById('winning-return').value ) ; 
	var sequence = document.getElementById('sequence-stream').innerHTML ; 
	var nb = sequence.split(', ') ; 
	new_sequence = '' ; 
	if( nb.length > 1 ) {
		if( winning_return == 1 ) { 
			nb.splice(0, 1);
			nb.splice((nb.length-2), 1);
			new_sequence = nb.join(', ') ; 
		}
		if( winning_return == 2 ) { 
			var last_seq = last_sequence.split(', ') ; 
			for( var i = 0 ; i < last_seq.length ; i++ ) { 
				for( var j in nb ) {
				    if( nb[j] == last_seq[i] ) {
				        nb.splice( j, 1 ) ;
				        break;
					}
				}
			}
			new_sequence = nb.join(', ') ; 
		}
	}
	document.getElementById('sequence-stream').innerHTML = new_sequence ; 
	document.getElementById('next-bet').innerHTML = next_bet() ; 

	total_wins++ ; 
	document.getElementById('total-wins').innerHTML = total_wins ; 

	spins() ; 	
}

function lose() { 
	var nextb = document.getElementById('next-bet') ; 
	document.getElementById('sequence-stream').innerHTML += nextb.innerHTML + ', ' ; 
	nextb.innerHTML = next_bet() ; 

	total_losses++ ; 
	document.getElementById('total-losses').innerHTML = total_losses ; 

	spins() ; 
}

function next_bet() { 
	var winning_return = parseFloat( document.getElementById('winning-return').value ) ; 
	var sequence = document.getElementById('sequence-stream').innerHTML ;
	var total_bet = parseFloat( document.getElementById('total-bet').innerHTML ) ; 
	var nb = sequence.split(', ') ; 
	var r = 0 ; 
	last_sequence = '' ; 
	if( nb.length <= 2 ) { 
		if( winning_return == 1 ) { 
			r = parseFloat( nb[0] ) ; 
		} else if( winning_return == 2 ) { 
			r = parseFloat(nb[0]/2).toFixed(2) ; 
		}
	} else if( nb.length > 1 ) {
		if( winning_return == 1 ) { 
			var first = parseFloat( nb[0] ) ; 
			var last = parseFloat( nb[(nb.length-2)] ) ; 
			r = parseFloat(first+last).toFixed(2) ;
		} else if( winning_return == 2 ) { 
			var total = 0 ; 
			if( nb.length > 5 ) { // losses to recoup
				i_start = nb.length - 5 ; 
				i_stop = nb.length ; 
			} else { 
				i_start = 0 ; 
				i_stop = nb.length ; 
			}
			for( var i = i_start ; i < i_stop ; i++ ) { 
				if( nb[i] > 0 ) { 
					total += parseFloat( nb[i] ) ; 
					last_sequence += nb[i] + ', ' ; 
				}
			}
			r = Math.ceil(parseFloat(total/2)).toFixed(2) ; 
		}
	}
	total_bet += parseFloat( r ).toFixed(2) ; 
	document.getElementById('total-bet').innerHTML = total_bet ; 
	return r ; 
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
	<td><input type="text" id="how-much" name="how_much" value="6"></td>
</tr>
<tr>
	<td>Define the arithmetic interval:</td>
	<td><input type="text" id="sequence-interval" name="sequence_interval" value="1"></td>
</tr>
<tr>
	<td>Inform the winning return:</td>
	<td><input type="text" id="winning-return" name="winning_return" value="1" size="2" maxlength="2">:1</td>
</tr>
<tr>
	<td colspan="2">
		<div id="my-sequence" class="div-o"></div>
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
		<input type="button" name="go" value="Go!" onClick="javascript:do_sequence();">

<br>
<br>
	</td>
</tr>
<tr>
	<td colspan="2">
		<b>next bet:</b>
		<div id="next-bet" style="float:right;" class="div-o"></div><br><br>
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

<br>
<br>

<table>
<tr>
	<td colspan="2"><b>spins:</b><div id="spins" style="float:right;" class="div-o">0</div></td>
	<td colspan="2"><b>wins:</b><div id="total-wins" style="float:right;" class="div-o">0</div></td>
	<td colspan="2"><b>losses:</b><div id="total-losses" style="float:right;" class="div-o">0</div></td>
	<td colspan="2"><b>total bet:</b><div id="total-bet" style="float:right;" class="div-o">0</div></td>
</tr>
</table>

</body>
</html>