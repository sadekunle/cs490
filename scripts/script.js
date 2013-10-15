

$( document ).ready(function() {
	allButtonsHide();

	$("#addQuestions").click(function(){
		allButtonsSlideUp();
		$("#addQuestionsDropDown").slideDown();
	});
	$("#makeTest").click(function(){
		allButtonsSlideUp();
		$("#makeTestDropDown").slideDown();
	});
	$("#GetReport").click(function(){
		allButtonsSlideUp();
		$("#GetReportDropDown").slideDown();
	});
	$("#seeTest").click(function(){
		allButtonsSlideUp();
		$("#seeTestDropDown").slideDown();
	});
	$("#seeHistory").click(function(){
		allButtonsSlideUp();
		$("#seeHistoryDropDown").slideDown();
	});
 
});

function allButtonsSlideUp(){
		$("#addQuestionsDropDown").slideUp();
		$("#makeTestDropDown").slideUp();
		$("#GetReportDropDown").slideUp();
		$("#seeTestDropDown").slideUp();
		$("#seeHistoryDropDown").slideUp();
}

function allButtonsHide(){
		$("#addQuestionsDropDown").hide();
		$("#makeTestDropDown").hide();
		$("#GetReportDropDown").hide();
		$("#seeTestDropDown").hide();
		$("#seeHistoryDropDown").hide();
}