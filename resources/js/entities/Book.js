/**
 * This class represents a Book
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var Book = function(genericObj) {

	/**
	 * @var	Number
	 */
	var _id = 0;

	/**
	 * @var	Order
	 */
	var _order = new Order();

	/**
	 * @var	String
	 */
	var _initDate = '';

	/**
	 * @var	String
	 */
	var _num_gross_income = '';

	/**
	 * @var	Number
	 */
	var _fromNumber = 0;

	/**
	 * @var	Number
	 */
	var _toNumber = 0;

	/**
	 * @var	String
	 */
	var _observation = '';

	/**
	 * Constructor
	 */
	var init = function() {
		if(Validator.IsInstanceOf('Object', genericObj)){
			$.each(genericObj, function(property, value){
				switch (property.toUpperCase()) {
					case 'ID':
						_setId(value);
						break;
					case 'ORDER':
						_setOrder(value);
						break;
					case 'INITDATE':
						_setInitDate(value);
						break;
					case 'NUM_GROSS_INCOME':
						_setNum_gross_income(value);
						break;
					case 'FROMNUMBER':
						_setFromNumber(value);
						break;
					case 'TONUMBER':
						_setToNumber(value);
						break;
					case 'OBSERVATION':
						_setObservation(value);
						break;
				}
			});
		}
	};

	/**
	 * @param	Number	id
	 */
	var _setId = function(id){
		_id = Number(id);
	};

	/**
	 * @param	Order	order
	 */
	var _setOrder = function(order){
		if(Validator.IsInstanceOf('Object', order)){
			_order = new Order(order);
		} else {
			console.error('Function expects an object as param. ( Book.setOrder )');
		}
	};

	/**
	 * @param	String	initDate
	 */
	var _setInitDate = function(initDate){
		_initDate = String(initDate);
	};

	/**
	 * @param	String	num_gross_income
	 */
	var _setNum_gross_income = function(num_gross_income){
		_num_gross_income = String(num_gross_income);
	};

	/**
	 * @param	Number	fromNumber
	 */
	var _setFromNumber = function(fromNumber){
		_fromNumber = Number(fromNumber);
	};

	/**
	 * @param	Number	toNumber
	 */
	var _setToNumber = function(toNumber){
		_toNumber = Number(toNumber);
	};

	/**
	 * @param	String	observation
	 */
	var _setObservation = function(observation){
		_observation = String(observation);
	};

	/**
	 * @return	Number
	 */
	var _getId = function(){
		return _id;
	};

	/**
	 * @return	Order
	 */
	var _getOrder = function(){
		return _order;
	};

	/**
	 * @return	String
	 */
	var _getInitDate = function(){
		return _initDate;
	};

	/**
	 * @return	String
	 */
	var _getNum_gross_income = function(){
		return _num_gross_income;
	};

	/**
	 * @return	Number
	 */
	var _getFromNumber = function(){
		return _fromNumber;
	};

	/**
	 * @return	Number
	 */
	var _getToNumber = function(){
		return _toNumber;
	};

	/**
	 * @return	String
	 */
	var _getObservation = function(){
		return _observation;
	};

	/**
	 * @return	JSON
	 */
	var _convertToArray = function(){
		return {
			"id":_id,
			"order":_order,
			"initDate":_initDate,
			"num_gross_income":_num_gross_income,
			"fromNumber":_fromNumber,
			"toNumber":_toNumber,
			"observation":_observation
		};
	};

	/**
	 * Executes constructor
	 */
	init();

	/**
	 * Returns public functions
	 */
	return{
		/**
		 * @param	Number	id
		 */
		setId : function(id){
			_setId(id);
		},

		/**
		 * @param	Order	order
		 */
		setOrder : function(order){
			_setOrder(order);
		},

		/**
		 * @param	String	initDate
		 */
		setInitDate : function(initDate){
			_setInitDate(initDate);
		},

		/**
		 * @param	String	num_gross_income
		 */
		setNum_gross_income : function(num_gross_income){
			_setNum_gross_income(num_gross_income);
		},

		/**
		 * @param	Number	fromNumber
		 */
		setFromNumber : function(fromNumber){
			_setFromNumber(fromNumber);
		},

		/**
		 * @param	Number	toNumber
		 */
		setToNumber : function(toNumber){
			_setToNumber(toNumber);
		},

		/**
		 * @param	String	observation
		 */
		setObservation : function(observation){
			_setObservation(observation);
		},

		/**
		 * @return	Number
		 */
		getId : function(){
			return _getId();
		},

		/**
		 * @return	Order
		 */
		getOrder : function(){
			return _getOrder();
		},

		/**
		 * @return	String
		 */
		getInitDate : function(){
			return _getInitDate();
		},

		/**
		 * @return	String
		 */
		getNum_gross_income : function(){
			return _getNum_gross_income();
		},

		/**
		 * @return	Number
		 */
		getFromNumber : function(){
			return _getFromNumber();
		},

		/**
		 * @return	Number
		 */
		getToNumber : function(){
			return _getToNumber();
		},

		/**
		 * @return	String
		 */
		getObservation : function(){
			return _getObservation();
		},

		/**
		 * @return	JSON
		 */
		convertToArray : function(){
			return _convertToArray();
		}
	};
};