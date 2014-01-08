/**
 * This class represents a Box
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var Box = function(genericObj) {

	/**
	 * @var	Number
	 */
	var _id = 0;

	/**
	 * @var	String
	 */
	var _date = '';

	/**
	 * @var	String
	 */
	var _type = '';

	/**
	 * @var	Number
	 */
	var _value = 0;

	/**
	 * @var	Order
	 */
	var _order = new Order();

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
					case 'DATE':
						_setDate(value);
						break;
					case 'TYPE':
						_setType(value);
						break;
					case 'VALUE':
						_setValue(value);
						break;
					case 'ORDER':
						_setOrder(value);
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
	 * @param	String	date
	 */
	var _setDate = function(date){
		_date = String(date);
	};

	/**
	 * @param	String	type
	 */
	var _setType = function(type){
		_type = String(type);
	};

	/**
	 * @param	Number	value
	 */
	var _setValue = function(value){
		_value = Number(value);
	};

	/**
	 * @param	Order	order
	 */
	var _setOrder = function(order){
		if(Validator.IsInstanceOf('Object', order)){
			_order = new Order(order);
		} else {
			console.error('Function expects an object as param. ( Box.setOrder )');
		}
	};

	/**
	 * @return	Number
	 */
	var _getId = function(){
		return _id;
	};

	/**
	 * @return	String
	 */
	var _getDate = function(){
		return _date;
	};

	/**
	 * @return	String
	 */
	var _getType = function(){
		return _type;
	};

	/**
	 * @return	Number
	 */
	var _getValue = function(){
		return _value;
	};

	/**
	 * @return	Order
	 */
	var _getOrder = function(){
		return _order;
	};

	/**
	 * @return	JSON
	 */
	var _convertToArray = function(){
		return {
			"id":_id,
			"date":_date,
			"type":_type,
			"value":_value,
			"order":_order
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
		 * @param	String	date
		 */
		setDate : function(date){
			_setDate(date);
		},

		/**
		 * @param	String	type
		 */
		setType : function(type){
			_setType(type);
		},

		/**
		 * @param	Number	value
		 */
		setValue : function(value){
			_setValue(value);
		},

		/**
		 * @param	Order	order
		 */
		setOrder : function(order){
			_setOrder(order);
		},

		/**
		 * @return	Number
		 */
		getId : function(){
			return _getId();
		},

		/**
		 * @return	String
		 */
		getDate : function(){
			return _getDate();
		},

		/**
		 * @return	String
		 */
		getType : function(){
			return _getType();
		},

		/**
		 * @return	Number
		 */
		getValue : function(){
			return _getValue();
		},

		/**
		 * @return	Order
		 */
		getOrder : function(){
			return _getOrder();
		},

		/**
		 * @return	JSON
		 */
		convertToArray : function(){
			return _convertToArray();
		}
	};
};