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
	show('#my-sequence');
	show('#game-stream');
}

function win() { 
	var winning_return = parseFloat( document.getElementById('winning-return').value ) ; 
	var sequence = document.getElementById('sequence-stream').innerHTML ; 
	var nb = sequence.split(', ') ; 
	var current_win = parseFloat( document.getElementById('current-win').innerHTML ) ; 
	new_sequence = '' ; 
	if( nb.length > 1 ) {
		if( winning_return == 1 ) { 
			if( nb[0] > 0 )
				current_win += parseFloat( nb[0] ) ; 
			nb.splice(0, 1);

			if( nb[nb.length-2] > 0 )
				current_win += parseFloat( nb[nb.length-2] ) ; 
			nb.splice((nb.length-2), 1);

			new_sequence = nb.join(', ') ; 
		}
		if( winning_return == 2 ) { 
			var last_seq = last_sequence.split(', ') ; 
			for( var i = 0 ; i < last_seq.length ; i++ ) { 
				for( var j in nb ) {
				    if( nb[j] == last_seq[i] ) {
				    	if( nb[j] > 0 ) 
				    		current_win += parseFloat( nb[j] ) ; 
				        nb.splice( j, 1 ) ;
				        break;
					}
				}
			}
			new_sequence = nb.join(', ') + ', ' ; 
		}
	}
	document.getElementById('sequence-stream').innerHTML = new_sequence ; 
	document.getElementById('next-bet').innerHTML = next_bet() ; 

	total_wins++ ; 
	document.getElementById('total-wins').innerHTML = total_wins ; 
	document.getElementById('current-win').innerHTML = current_win.toFixed(2) ; 

	spins() ; 	
}

function lose() { 
	var nextb = document.getElementById('next-bet') ; 
	document.getElementById('sequence-stream').innerHTML += nextb.innerHTML + ', ' ; 
	var current_loss = parseFloat( document.getElementById('current-loss').innerHTML ) ; 
	if( parseFloat( nextb.innerHTML ) > 0 )
		current_loss += parseFloat( nextb.innerHTML ) ; 

	nextb.innerHTML = next_bet() ; 

	total_losses++ ; 
	document.getElementById('total-losses').innerHTML = total_losses ; 
	document.getElementById('current-loss').innerHTML = current_loss.toFixed(2) ; 

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
			if( nb[0] > 0 ) 
				r = parseFloat( nb[0] ).toFixed(2) ; 
		} else if( winning_return == 2 ) { 
			if( nb[0]/2 > 0 )
				r = parseFloat(nb[0]/2).toFixed(2) ; 
		}
	} else if( nb.length > 1 ) {
		if( winning_return == 1 ) { 
			var first = parseFloat( nb[0] ) ; 
			var last = parseFloat( nb[(nb.length-2)] ) ; 
			if( first+last > 0 )
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
			if( total/2 > 0 )
				r = Math.ceil(parseFloat(total/2)).toFixed(2) ; 
		}
	}
	if( r > 0 ) { 
		total_bet += parseFloat( r ) ; 
		document.getElementById('total-bet').innerHTML = total_bet.toFixed(2) ; 
	}
	return r ; 
}

function spins() { 
	spin++ ; 
	document.getElementById('spins').innerHTML = spin ; 
}

