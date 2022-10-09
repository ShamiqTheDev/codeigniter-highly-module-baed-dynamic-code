function getConditionTypeOptions() {
	getOptions('get','conditionTypeOptions','Condition Type','','ConditionType');
}
// function getModuleOptions() {
// 	getOptions('get','moduleOptions','Module','','Module');
// }

$(document).ready(function () {
	getConditionTypeOptions();
});