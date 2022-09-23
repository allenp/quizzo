jQuery(document).ready(function ($) {

	$('.quizzo_shortcode input[type="radio"]').click(function () {
		//console.log($(this).val());
	})

	$('.quizzo_shortcode #answer').click(function () {
		// Check to see if button has been clicked before
		if ($(this).text() == 'Continue') location.reload();

		// Get answerID
		let questionID = $('.quizzo_shortcode').attr('id');
		let answerID = $('.quizzo_shortcode input[type="radio"]:checked').val();

		// Perform AJAX operation...
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'save_user_answer',
				question_id: questionID,
				answer_id: answerID
			},
			success: function (msg) {
				// Display feedback
				$('.quizzo_shortcode #status').slideDown('fast', 'swing');

				// Disable question
				$('.quizzo_shortcode #overlay').fadeIn('fast');

				// Grab correct answer
				let answer = {
					1: 'A',
					2: 'B',
					3: 'C',
					4: 'D'
				}

				// Display message
				if (parseInt(msg.status)) {
					$('.quizzo_shortcode #status').html('<span class= "dashicons dashicons-yes"></span>Congratulations! You got the question right...');
					$('.quizzo_shortcode #status').css('background-color', 'rebeccapurple');
				} else {
					$('.quizzo_shortcode #status').html('<span class= "dashicons dashicons-no-alt"></span>The correct answer is ' + answer[msg.question]);
					$('.quizzo_shortcode #status').css({
						'background-color': 'red',
					});
				}

				// Change button
				$('.quizzo_shortcode #answer').text('Continue');
			}
		});

	})

})

