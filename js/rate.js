function highlightStar(obj,id) {
	removeHighlight(id);		
	$('.rating-div #rating-'+id+' li').each(function(index) {
		$(this).addClass('highlight');
		if(index == $('.rating-div #rating-'+id+' li').index(obj)) {
			return false;	
		}
	});
}

function removeHighlight(id) {
	$('.rating-div #rating-'+id+' li').removeClass('selected');
	$('.rating-div #rating-'+id+' li').removeClass('highlight');
}

function addRating(obj,id) {
	$('.rating-div #rating-'+id+' li').each(function(index) {
		$(this).addClass('selected');
		$('#rating-'+id+' #rating').val((index+1));
		if(index == $('.rating-div #rating-'+id+' li').index(obj)) {
			return false;	
		}
	});
	$.ajax({
	url: "actions.php",
	data:'ePage=add_rating&case='+id+'&rating='+$('#rating-'+id+' #rating').val(),
	type: "POST"
	});
}

function addRatingOnChecks(obj,id) {
	$('.rating-div #rating-'+id+' li').each(function(index) {
		$(this).addClass('selected');
		$('#rating-'+id+' #rating').val((index+1));
		if(index == $('.rating-div #rating-'+id+' li').index(obj)) {
			return false;	
		}
	});
	$.ajax({
	url: "actions.php",
	data:'ePage=add_rating&check_id='+id+'&rating='+$('#rating-'+id+' #rating').val(),
	type: "POST"
	});
}

function resetRating(id) {
	if($('#rating-'+id+' #rating').val() != 0) {
		$('.rating-div #rating-'+id+' li').each(function(index) {
			$(this).addClass('selected');
			if((index+1) == $('#rating-'+id+' #rating').val()) {
				return false;	
			}
		});
	}
} 