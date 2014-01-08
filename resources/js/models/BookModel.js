/**
 * This class  performs server queries for Book
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var BookModel = function() {

};

/**
 * Saves a Book in the server
 * 
 * @param	Book	book
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BookModel.Save = function(book, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'book',
		action : 'save',
		params : book
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			uiFunction(data, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BookModel.Save()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves a Book from the server and gives it to the callback function
 *
 * @param	int	bookId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BookModel.FindById = function(bookId, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'book',
		action : 'findById',
		params : bookId
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			uiFunction(new Book(genericObject), callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BookModel.FindById()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves Book from the server that matches the queryParams
 * filters and gives it to the callback function
 *
 * @param	int	bookId
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BookModel.FindBy = function(queryParams, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'book',
		action : 'findBy',
		params : queryParams
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObject = JSON.parse(data);
			var booksArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				booksArray.push(new Book(genericObject));
			});
			uiFunction(booksArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BookModel.FindBy()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves Book from the server that matches the queryParams
 * filters and gives it to the callback function
 *
 * @param	object	queryParams
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BookModel.FindByOrderProperties = function(queryParams, uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'book',
		action : 'FindByOrderProperties',
		params : queryParams
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObjectArray = JSON.parse(data);
			var booksArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				booksArray.push(new Book(genericObject));
			});
			uiFunction(booksArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BookModel.FindByOrderProperties()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
/**
 * Retrieves all Books from the server and gives it to the callback function
 *
 * @param	function	uiFunction
 * @param	object	uiExtraParams
 * @static
 */
BookModel.FetchAll = function(uiFunction, uiExtraParams){
	var ajaxParams = {
		obj : 'book',
		action : 'FetchAll'
	};
	var callbackFunction = function(data, callbackExtraParams){
		if(data){
			var genericObjectsArray = JSON.parse(data);
			var booksArray = new Array();
			$.each(genericObjectsArray, function(index, genericObject){
				booksArray.push(new Book(genericObject));
			});
			uiFunction(booksArray, callbackExtraParams);
		} else {
			console.error("Unable to parse server response.BookModel.FetchAll()");
		}
	};
	Ajax.Perform(ajaxParams, callbackFunction, uiExtraParams);
};
