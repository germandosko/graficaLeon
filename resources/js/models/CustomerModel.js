/**
 * This class  performs server queries for Customer
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var CustomerModel = function() {

};

/**
 * Saves a Customer in the server
 * 
 * @param	Customer	customer
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
CustomerModel.Save = function(customer, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'customer',
		action : 'save',
		params : customer
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			uiFunction(data, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.CustomerModel.Save()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves a Customer from the server and gives it to the callback function
 *
 * @param	int	customerId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
CustomerModel.FindById = function(customerId, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'customer',
		action : 'findById',
		params : customerId
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			uiFunction(new Customer(genericObject), callbackExtraParams);
		} else {
			console.error("Unable to parse server response.CustomerModel.FindById()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves Customer from the server that matches the queryParams
 * filters and gives it to the callback function
 *
 * @param	int	customerId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
CustomerModel.FindBy = function(queryParams, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'customer',
		action : 'findBy',
		params : queryParams
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			var customersArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				customersArray.push(new Customer(genericObject));
			});
			uiFunction(customersArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.CustomerModel.FindBy()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves all Customers from the server and gives it to the callback function
 *
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
CustomerModel.FetchAll = function(uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'customer',
		action : 'FetchAll'
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObjectsArray = JSON.parse(data);
			var customersArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				customersArray.push(new Customer(genericObject));
			});
			uiFunction(customersArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.CustomerModel.FetchAll()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
