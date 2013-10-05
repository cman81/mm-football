$(document).ready(function(){
	$('.registration-page .league.field select').change(function() {
		if ($(this).val() == '~NEW~') {
			$('.new-league.field').show();
			$('.new-league-launch.field').show();
		} else {
			$('.new-league.field').hide();
			$('.new-league-launch.field').hide();
		}
	});
});