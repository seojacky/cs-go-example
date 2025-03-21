jQuery(document).ready(function($){
	$('.steam_stats__form__submit').on('click', function(e) {
		e.preventDefault();
		//console.log($('.steam_stats__form__username').val());

		$.ajax({
			'url': 'api/?user=' + $('.steam_stats__form__username').val(),
			'method': 'get',
			'beforeSend': function() {
				$('#block-loading').show();
			},
			'success': function(result) {
				if ($('#block_stats').length) {
					$('#block_stats').replaceWith($(result).find('#block_stats'));
				} else {
					$('.table-responsive').replaceWith($(result).find('#block_stats'));	
				}
				
				$('#block-loading').hide();
				$('#showMoreButton').hide();
			}, 
			'complete': function() {
				$('.text').hide();

				if ($('.steam_stats__form__username')) {
					window.history.pushState('', '', '/cs-go?action=view&user=' + $('.steam_stats__form__username').val());
				}
			}
		});
	});
});
