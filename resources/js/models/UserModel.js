/**
 * This class  performs server queries for User
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var UserModel = function() {

};

/**
 * Saves a User in the server
 * 
 * @param	User	user
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
UserModel.Save = function(user, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'user',
		action : 'save',
		params : user
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			uiFunction(data, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.UserModel.Save()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves a User from the server and gives it to the callback function
 *
 * @param	int	userId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
UserModel.FindById = function(userId, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'user',
		action : 'findById',
		params : userId
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			uiFunction(new User(genericObject), callbackExtraParams);
		} else {
			console.error("Unable to parse server response.UserModel.FindById()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves User from the server that matches the queryParams
 * filters and gives it to the callback function
 *
 * @param	int	userId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
UserModel.FindBy = function(queryParams, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'user',
		action : 'findBy',
		params : queryParams
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			var usersArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				usersArray.push(new User(genericObject));
			});
			uiFunction(usersArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.UserModel.FindBy()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves all Users from the server and gives it to the callback function
 *
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
UserModel.FetchAll = function(uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'user',
		action : 'FetchAll'
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObjectsArray = JSON.parse(data);
			var usersArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				usersArray.push(new User(genericObject));
			});
			uiFunction(usersArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.UserModel.FetchAll()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
