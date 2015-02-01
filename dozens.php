<?
include("templates/header.html") ; 
?>

<script type="text/javascript">
var counter = 0 ; 
var counter_l = 0 ; 
var counter_m = 0 ; 
var counter_h = 0 ; 
var chance_count_l = 0 ; 
var chance_count_m = 0 ; 
var chance_count_h = 0 ; 

function do_sequence( s ) { 
	$('#roulette-sequence').append( s + ' ' ) ; 
	switch( s ) { 
		case 'L' : 
			counter_l++ ; 
			chance_count_l = 0 ; 
			chance_count_m-- ; 
			chance_count_h-- ; 
			break ; 
		case 'M' : 
			counter_m++ ; 
			chance_count_l-- ; 
			chance_count_m = 0 
			chance_count_h-- ; 
			break ; 
		case 'H' : 
			counter_h++ ; 
			chance_count_l-- ; 
			chance_count_m-- ; 
			chance_count_h = 0 ; 
			break ; 
		case 'Z' : 
			counter_l = counter_m = counter_h = 0 ; 
	}
	counter++ ; 
	perc_l = parseFloat( ( counter_l / counter ) * 100 ) ; 
	perc_m = parseFloat( ( counter_m / counter ) * 100 ) ; 
	perc_h = parseFloat( ( counter_h / counter ) * 100 ) ; 

	perc_change_l = parseFloat( 100 - perc_l ) ; 
	perc_change_m = parseFloat( 100 - perc_m ) ; 
	perc_change_h = parseFloat( 100 - perc_h ) ; 

	if( perc_change_l >= 100 ) perc_change_l = 99.99 ;
	if( perc_change_m >= 100 ) perc_change_m = 99.99 ;
	if( perc_change_h >= 100 ) perc_change_h = 99.99 ;

	$('#count-low').html( counter_l ) ; 
	$('#count-middle').html( counter_m ) ; 
	$('#count-high').html( counter_h ) ; 

	$('#prob-low').html( perc_l.toFixed(2) ) ; 
	$('#prob-middle').html( perc_m.toFixed(2) ) ; 
	$('#prob-high').html( perc_h.toFixed(2) ) ; 

	$('#chance-low').html( perc_change_l.toFixed(2) ) ; 
	$('#chance-middle').html( perc_change_m.toFixed(2) ) ; 
	$('#chance-high').html( perc_change_h.toFixed(2) ) ; 

	set_status( chance_count_l, '#chance-low' ) ; 
	set_status( chance_count_m, '#chance-middle' ) ; 
	set_status( chance_count_h, '#chance-danger' ) ; 
}

function set_status( n, elid ) { 
	if( n <= -7 ) { 
		$( elid ).addClass("btn-warning") ; 
	} else { 
		$( elid ).removeClass("btn-warning") ; 
	}

	if( n <= -8 ) { 
		$( elid ).addClass("btn-danger") ; 
		$( elid ).removeClass("btn-warning") ; 
	} else { 
		$( elid ).removeClass("btn-danger") ; 
	}

	if( n <= -12 ) { 
		$( elid ).addClass("active") ; 
	} else { 
		$( elid ).removeClass("active") ; 
	}
}
</script>

<div class="container">
	<tt><a href="index.php">Roulette Strategies</a> > Dozens</tt>
	<hr>

	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 well">
		<b>L</b>ow: 1-12.
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 well">
		<b>M</b>iddle: 13-24.
	</div>
	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 well">
		<b>H</b>igh: 25-36.
	</div>

	<div class="clearfix"></div>

	<div>
		Inform the spin result: 

		<button onClick="javascript:do_sequence('L');" class="btn btn-lg btn-primary" id="d-low">L</button> &nbsp;&nbsp;&nbsp;
		<button onClick="javascript:do_sequence('M');" class="btn btn-lg btn-primary" id="d-middle">M</button> &nbsp;&nbsp;&nbsp;
		<button onClick="javascript:do_sequence('H');" class="btn btn-lg btn-primary" id="d-high">H</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button onClick="javascript:do_sequence('Z');" class="btn btn-lg btn-danger" id="d-high">reset</button> &nbsp;&nbsp;&nbsp;
	</div>

	<br>
	<br>

	<div>
		Sequence:
		<div id="roulette-sequence" class="div-o"></div>
	</div>

	<br><br>

	Odds: 
	<br>

	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		L: <span id="count-low">0</span>/<span id="prob-low">0</span>%
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		M: <span id="count-middle">0</span>/<span id="prob-middle">0</span>%
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		H: <span id="count-high">0</span>/<span id="prob-high">0</span>%
	</div>

	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<span id="chance-low" class="btn btn-lg">100</span>%
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<span id="chance-middle" class="btn btn-lg">100</span>%
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<span id="chance-high" class="btn btn-lg">100</span>%
	</div>

</div>

<?
include("templates/footer.html") ; 
?>