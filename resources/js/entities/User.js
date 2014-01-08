/**
 * This class represents a User
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var User = function(genericObj) {

	/**
	 * @var	Number
	 */
	var _id = 0;

	/**
	 * @var	String
	 */
	var _name = '';

	/**
	 * @var	String
	 */
	var _nick = '';

	/**
	 * @var	String
	 */
	var _password = '';

	/**
	 * @var	String
	 */
	var _lastAcces = '';

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
					case 'NAME':
						_setName(value);
						break;
					case 'NICK':
						_setNick(value);
						break;
					case 'PASSWORD':
						_setPassword(value);
						break;
					case 'LASTACCES':
						_setLastAcces(value);
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
	 * @param	String	name
	 */
	var _setName = function(name){
		_name = String(name);
	};

	/**
	 * @param	String	nick
	 */
	var _setNick = function(nick){
		_nick = String(nick);
	};

	/**
	 * @param	String	password
	 */
	var _setPassword = function(password){
		_password = String(password);
	};

	/**
	 * @param	String	lastAcces
	 */
	var _setLastAcces = function(lastAcces){
		_lastAcces = String(lastAcces);
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
	var _getName = function(){
		return _name;
	};

	/**
	 * @return	String
	 */
	var _getNick = function(){
		return _nick;
	};

	/**
	 * @return	String
	 */
	var _getPassword = function(){
		return _password;
	};

	/**
	 * @return	String
	 */
	var _getLastAcces = function(){
		return _lastAcces;
	};

	/**
	 * @return	JSON
	 */
	var _convertToArray = function(){
		return {
			"id":_id,
			"name":_name,
			"nick":_nick,
			"password":_password,
			"lastAcces":_lastAcces
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
		 * @param	String	name
		 */
		setName : function(name){
			_setName(name);
		},

		/**
		 * @param	String	nick
		 */
		setNick : function(nick){
			_setNick(nick);
		},

		/**
		 * @param	String	password
		 */
		setPassword : function(password){
			_setPassword(password);
		},

		/**
		 * @param	String	lastAcces
		 */
		setLastAcces : function(lastAcces){
			_setLastAcces(lastAcces);
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
		getName : function(){
			return _getName();
		},

		/**
		 * @return	String
		 */
		getNick : function(){
			return _getNick();
		},

		/**
		 * @return	String
		 */
		getPassword : function(){
			return _getPassword();
		},

		/**
		 * @return	String
		 */
		getLastAcces : function(){
			return _getLastAcces();
		},

		/**
		 * @return	JSON
		 */
		convertToArray : function(){
			return _convertToArray();
		}
	};
};