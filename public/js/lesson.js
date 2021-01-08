let question_count = 0;
$('#addquestion').click(function(event) {
	question_count++;
	document.getElementById('addquestion').insertAdjacentHTML('beforebegin', '<a class="list-group-item list-group-item-action list-group-item-light p-5"><div class="row"><div class="col-12"><input type="text" placeholder="Запитання" class="form-control background-light-grey border-0 color-dark-grey rounded-15" name="question_'+ question_count +'"></div><div class="col-6"><input type="text" placeholder="Правильна відповідь" class="form-control bg-success border-0 text-white color-light-grey rounded-15 mt-2 placeholder-light-grey" name="correct_'+ question_count +'"></div><div class="col-6"><input type="text" placeholder="Варіант відповіді" class="form-control background-light-grey border-0 color-dark-grey rounded-15 mt-2" name="answer2_'+ question_count +'"></div><div class="col-6"><input type="text" placeholder="Варіант відповіді" class="form-control background-light-grey border-0 color-dark-grey rounded-15 mt-2" name="answer3_'+ question_count +'"></div><div class="col-6"><input type="text" placeholder="Варіант відповіді" class="form-control background-light-grey border-0 color-dark-grey rounded-15 mt-2" name="answer4_'+ question_count +'"></div></div></a>');
	document.getElementById('question_count').setAttribute("value", question_count);
});



function registrationTimer(id){
	$.ajax({
		type:'POST',
		url:'{{ route("getregisteredstudents") }}',
		data: "lesson_id=" + id,
		dataType:'text',
		success:function(data){
			var question = jQuery.parseJSON(data);
			$('#questionModalLabel').text(question.question);
			$('#answer1_label').text(question.first_answer);
			$('#answer2_label').text(question.second_answer);
			$('#answer3_label').text(question.third_answer);
			$('#answer4_label').text(question.fourth_answer);
			$('#questionModal').modal('show');
		}
	});
}