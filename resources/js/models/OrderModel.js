/**
 * This class  performs server queries for Order
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var OrderModel = function() {

};

/**
 * Saves a Order in the server
 * 
 * @param	Order	order
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
OrderModel.Save = function(order, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'order',
		action : 'save',
		params : order
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			uiFunction(data, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.OrderModel.Save()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves a Order from the server and gives it to the callback function
 *
 * @param	int	orderId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
OrderModel.FindById = function(orderId, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'order',
		action : 'findById',
		params : orderId
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			uiFunction(new Order(genericObject), callbackExtraParams);
		} else {
			console.error("Unable to parse server response.OrderModel.FindById()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves Order from the server that matches the queryParams
 * filters and gives it to the callback function
 *
 * @param	int	orderId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
OrderModel.FindBy = function(queryParams, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'order',
		action : 'findBy',
		params : queryParams
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			var ordersArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				ordersArray.push(new Order(genericObject));
			});
			uiFunction(ordersArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.OrderModel.FindBy()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves Order from the server that matches the queryParams
 * filters and gives it to the callback function
 *
 * @param	object	queryParams
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
OrderModel.FindByCustomerProperties = function(queryParams, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'order',
		action : 'FindByCustomerProperties',
		params : queryParams
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObjectArray = JSON.parse(data);
			var ordersArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				ordersArray.push(new Order(genericObject));
			});
			uiFunction(ordersArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.OrderModel.FindByCustomerProperties()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves all Orders from the server and gives it to the callback function
 *
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
OrderModel.FetchAll = function(uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'order',
		action : 'FetchAll'
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObjectsArray = JSON.parse(data);
			var ordersArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				ordersArray.push(new Order(genericObject));
			});
			uiFunction(ordersArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.OrderModel.FetchAll()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
