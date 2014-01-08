/**
 * This class represents a Customer
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var Customer = function(genericObj) {

	/**
	 * @var	Number
	 */
	var _id = 0;

	/**
	 * @var	String
	 */
	var _cuit = '';

	/**
	 * @var	String
	 */
	var _name = '';

	/**
	 * @var	String
	 */
	var _lastName = '';

	/**
	 * @var	String
	 */
	var _businessName = '';

	/**
	 * @var	String
	 */
	var _address = '';

	/**
	 * @var	Number
	 */
	var _addressNum = 0;

	/**
	 * @var	String
	 */
	var _city = '';

	/**
	 * @var	String
	 */
	var _email = '';

	/**
	 * @var	String
	 */
	var _phone = '';

	/**
	 * @var	String
	 */
	var _cellPhone = '';

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
					case 'CUIT':
						_setCuit(value);
						break;
					case 'NAME':
						_setName(value);
						break;
					case 'LASTNAME':
						_setLastName(value);
						break;
					case 'BUSINESSNAME':
						_setBusinessName(value);
						break;
					case 'ADDRESS':
						_setAddress(value);
						break;
					case 'ADDRESSNUM':
						_setAddressNum(value);
						break;
					case 'CITY':
						_setCity(value);
						break;
					case 'EMAIL':
						_setEmail(value);
						break;
					case 'PHONE':
						_setPhone(value);
						break;
					case 'CELLPHONE':
						_setCellPhone(value);
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
	 * @param	String	cuit
	 */
	var _setCuit = function(cuit){
		_cuit = String(cuit);
	};

	/**
	 * @param	String	name
	 */
	var _setName = function(name){
		_name = String(name);
	};

	/**
	 * @param	String	lastName
	 */
	var _setLastName = function(lastName){
		_lastName = String(lastName);
	};

	/**
	 * @param	String	businessName
	 */
	var _setBusinessName = function(businessName){
		_businessName = String(businessName);
	};

	/**
	 * @param	String	address
	 */
	var _setAddress = function(address){
		_address = String(address);
	};

	/**
	 * @param	Number	addressNum
	 */
	var _setAddressNum = function(addressNum){
		_addressNum = Number(addressNum);
	};

	/**
	 * @param	String	city
	 */
	var _setCity = function(city){
		_city = String(city);
	};

	/**
	 * @param	String	email
	 */
	var _setEmail = function(email){
		_email = String(email);
	};

	/**
	 * @param	String	phone
	 */
	var _setPhone = function(phone){
		_phone = String(phone);
	};

	/**
	 * @param	String	cellPhone
	 */
	var _setCellPhone = function(cellPhone){
		_cellPhone = String(cellPhone);
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
	var _getCuit = function(){
		return _cuit;
	};

	/**
	 * @return	String
	 */
	var _getName = function(){
		return _name;
	};

	/**
	 * @return	String
	 */
	var _getLastName = function(){
		return _lastName;
	};

	/**
	 * @return	String
	 */
	var _getBusinessName = function(){
		return _businessName;
	};

	/**
	 * @return	String
	 */
	var _getAddress = function(){
		return _address;
	};

	/**
	 * @return	Number
	 */
	var _getAddressNum = function(){
		return _addressNum;
	};

	/**
	 * @return	String
	 */
	var _getCity = function(){
		return _city;
	};

	/**
	 * @return	String
	 */
	var _getEmail = function(){
		return _email;
	};

	/**
	 * @return	String
	 */
	var _getPhone = function(){
		return _phone;
	};

	/**
	 * @return	String
	 */
	var _getCellPhone = function(){
		return _cellPhone;
	};

	/**
	 * @return	JSON
	 */
	var _convertToArray = function(){
		return {
			"id":_id,
			"cuit":_cuit,
			"name":_name,
			"lastName":_lastName,
			"businessName":_businessName,
			"address":_address,
			"addressNum":_addressNum,
			"city":_city,
			"email":_email,
			"phone":_phone,
			"cellPhone":_cellPhone
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
		 * @param	String	cuit
		 */
		setCuit : function(cuit){
			_setCuit(cuit);
		},

		/**
		 * @param	String	name
		 */
		setName : function(name){
			_setName(name);
		},

		/**
		 * @param	String	lastName
		 */
		setLastName : function(lastName){
			_setLastName(lastName);
		},

		/**
		 * @param	String	businessName
		 */
		setBusinessName : function(businessName){
			_setBusinessName(businessName);
		},

		/**
		 * @param	String	address
		 */
		setAddress : function(address){
			_setAddress(address);
		},

		/**
		 * @param	Number	addressNum
		 */
		setAddressNum : function(addressNum){
			_setAddressNum(addressNum);
		},

		/**
		 * @param	String	city
		 */
		setCity : function(city){
			_setCity(city);
		},

		/**
		 * @param	String	email
		 */
		setEmail : function(email){
			_setEmail(email);
		},

		/**
		 * @param	String	phone
		 */
		setPhone : function(phone){
			_setPhone(phone);
		},

		/**
		 * @param	String	cellPhone
		 */
		setCellPhone : function(cellPhone){
			_setCellPhone(cellPhone);
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
		getCuit : function(){
			return _getCuit();
		},

		/**
		 * @return	String
		 */
		getName : function(){
			return _getName();
		},

		/**
		 * @return	String
		 */
		getLastName : function(){
			return _getLastName();
		},

		/**
		 * @return	String
		 */
		getBusinessName : function(){
			return _getBusinessName();
		},

		/**
		 * @return	String
		 */
		getAddress : function(){
			return _getAddress();
		},

		/**
		 * @return	Number
		 */
		getAddressNum : function(){
			return _getAddressNum();
		},

		/**
		 * @return	String
		 */
		getCity : function(){
			return _getCity();
		},

		/**
		 * @return	String
		 */
		getEmail : function(){
			return _getEmail();
		},

		/**
		 * @return	String
		 */
		getPhone : function(){
			return _getPhone();
		},

		/**
		 * @return	String
		 */
		getCellPhone : function(){
			return _getCellPhone();
		},

		/**
		 * @return	JSON
		 */
		convertToArray : function(){
			return _convertToArray();
		}
	};
};