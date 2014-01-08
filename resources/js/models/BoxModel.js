/**
 * This class  performs server queries for Box
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var BoxModel = function() {

};

/**
 * Saves a Box in the server
 * 
 * @param	Box	box
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BoxModel.Save = function(box, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'box',
		action : 'save',
		params : box
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			uiFunction(data, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BoxModel.Save()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves a Box from the server and gives it to the callback function
 *
 * @param	int	boxId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BoxModel.FindById = function(boxId, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'box',
		action : 'findById',
		params : boxId
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			uiFunction(new Box(genericObject), callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BoxModel.FindById()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves Box from the server that matches the queryParams
 * filters and gives it to the callback function
 *
 * @param	int	boxId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BoxModel.FindBy = function(queryParams, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'box',
		action : 'findBy',
		params : queryParams
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			var boxesArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				boxesArray.push(new Box(genericObject));
			});
			uiFunction(boxesArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BoxModel.FindBy()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves Box from the server that matches the queryParams
 * filters and gives it to the callback function
 *
 * @param	object	queryParams
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BoxModel.FindByOrderProperties = function(queryParams, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'box',
		action : 'FindByOrderProperties',
		params : queryParams
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObjectArray = JSON.parse(data);
			var boxesArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				boxesArray.push(new Box(genericObject));
			});
			uiFunction(boxesArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BoxModel.FindByOrderProperties()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves all Boxes from the server and gives it to the callback function
 *
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BoxModel.FetchAll = function(uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'box',
		action : 'FetchAll'
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObjectsArray = JSON.parse(data);
			var boxesArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				boxesArray.push(new Box(genericObject));
			});
			uiFunction(boxesArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BoxModel.FetchAll()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
