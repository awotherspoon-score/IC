
//generic functions copy-pasted in 
//pulling these out into an include would be a good refactoring exercise
function metaToggle() {
        $("#meta-inputs").toggle('fast');
        $("#meta-toggle-button img").each(swapPlusMinus);
        return false;
}

function swapPlusMinus() {
	var plusPath = "img/icons/plus.gif";
	var minusPath = "img/icons/minus.gif";
	if (this['src'].indexOf(plusPath) == -1) {
		this['src'] = plusPath;
	} else {
		this['src'] = minusPath;
	}
}

$('#add-suggested-link-button').click( function() {
});
