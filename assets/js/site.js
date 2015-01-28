function hide(el) { 
	$(el).hide() ; 
}

function show(el) { 
	$(el).show() ; 
	$(el).removeClass('hide') ; 
}