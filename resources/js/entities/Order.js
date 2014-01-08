/**
 * This class represents a Order
 *
 * @author	German Dosko
 * @version	August 30 , 2012
 */
var Order = function(genericObj) {

	/**
	 * @var	Number
	 */
	var _id = 0;

	/**
	 * @var	Number
	 */
	var _date = 0;

	/**
	 * @var	Customer
	 */
	var _customer = new Customer();

	/**
	 * @var	String
	 */
	var _description = '';

	/**
	 * @var	String
	 */
	var _state = '';

	/**
	 * @var	Number
	 */
	var _total = 0;

	/**
	 * @var	Number
	 */
	var _advance = 0;

	/**
	 * @var	String
	 */
	var _deliveryDate = '';

	/**
	 * @var	Number
	 */
	var _amount = 0;

	/**
	 * @var	String
	 */
	var _paper = '';

	/**
	 * @var	Number
	 */
	var _weight = 0;

	/**
	 * @var	String
	 */
	var _machine = '';

	/**
	 * @var	String
	 */
	var _termination = '';

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
					case 'CUSTOMER':
						_setCustomer(value);
						break;
					case 'DESCRIPTION':
						_setDescription(value);
						break;
					case 'STATE':
						_setState(value);
						break;
					case 'TOTAL':
						_setTotal(value);
						break;
					case 'ADVANCE':
						_setAdvance(value);
						break;
					case 'DELIVERYDATE':
						_setDeliveryDate(value);
						break;
					case 'AMOUNT':
						_setAmount(value);
						break;
					case 'PAPER':
						_setPaper(value);
						break;
					case 'WEIGHT':
						_setWeight(value);
						break;
					case 'MACHINE':
						_setMachine(value);
						break;
					case 'TERMINATION':
						_setTermination(value);
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
	 * @param	Number	date
	 */
	var _setDate = function(date){
		_date = Number(date);
	};

	/**
	 * @param	Customer	customer
	 */
	var _setCustomer = function(customer){
		if(Validator.IsInstanceOf('Object', customer)){
			_customer = new Customer(customer);
		} else {
			console.error('Function expects an object as param. ( Order.setCustomer )');
		}
	};

	/**
	 * @param	String	description
	 */
	var _setDescription = function(description){
		_description = String(description);
	};

	/**
	 * @param	String	state
	 */
	var _setState = function(state){
		_state = String(state);
	};

	/**
	 * @param	Number	total
	 */
	var _setTotal = function(total){
		_total = Number(total);
	};

	/**
	 * @param	Number	advance
	 */
	var _setAdvance = function(advance){
		_advance = Number(advance);
	};

	/**
	 * @param	String	deliveryDate
	 */
	var _setDeliveryDate = function(deliveryDate){
		_deliveryDate = String(deliveryDate);
	};

	/**
	 * @param	Number	amount
	 */
	var _setAmount = function(amount){
		_amount = Number(amount);
	};

	/**
	 * @param	String	paper
	 */
	var _setPaper = function(paper){
		_paper = String(paper);
	};

	/**
	 * @param	Number	weight
	 */
	var _setWeight = function(weight){
		_weight = Number(weight);
	};

	/**
	 * @param	String	machine
	 */
	var _setMachine = function(machine){
		_machine = String(machine);
	};

	/**
	 * @param	String	termination
	 */
	var _setTermination = function(termination){
		_termination = String(termination);
	};

	/**
	 * @return	Number
	 */
	var _getId = function(){
		return _id;
	};

	/**
	 * @return	Number
	 */
	var _getDate = function(){
		return _date;
	};

	/**
	 * @return	Customer
	 */
	var _getCustomer = function(){
		return _customer;
	};

	/**
	 * @return	String
	 */
	var _getDescription = function(){
		return _description;
	};

	/**
	 * @return	String
	 */
	var _getState = function(){
		return _state;
	};

	/**
	 * @return	Number
	 */
	var _getTotal = function(){
		return _total;
	};

	/**
	 * @return	Number
	 */
	var _getAdvance = function(){
		return _advance;
	};

	/**
	 * @return	String
	 */
	var _getDeliveryDate = function(){
		return _deliveryDate;
	};

	/**
	 * @return	Number
	 */
	var _getAmount = function(){
		return _amount;
	};

	/**
	 * @return	String
	 */
	var _getPaper = function(){
		return _paper;
	};

	/**
	 * @return	Number
	 */
	var _getWeight = function(){
		return _weight;
	};

	/**
	 * @return	String
	 */
	var _getMachine = function(){
		return _machine;
	};

	/**
	 * @return	String
	 */
	var _getTermination = function(){
		return _termination;
	};

	/**
	 * @return	JSON
	 */
	var _convertToArray = function(){
		return {
			"id":_id,
			"date":_date,
			"customer":_customer,
			"description":_description,
			"state":_state,
			"total":_total,
			"advance":_advance,
			"deliveryDate":_deliveryDate,
			"amount":_amount,
			"paper":_paper,
			"weight":_weight,
			"machine":_machine,
			"termination":_termination
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
		 * @param	Number	date
		 */
		setDate : function(date){
			_setDate(date);
		},

		/**
		 * @param	Customer	customer
		 */
		setCustomer : function(customer){
			_setCustomer(customer);
		},

		/**
		 * @param	String	description
		 */
		setDescription : function(description){
			_setDescription(description);
		},

		/**
		 * @param	String	state
		 */
		setState : function(state){
			_setState(state);
		},

		/**
		 * @param	Number	total
		 */
		setTotal : function(total){
			_setTotal(total);
		},

		/**
		 * @param	Number	advance
		 */
		setAdvance : function(advance){
			_setAdvance(advance);
		},

		/**
		 * @param	String	deliveryDate
		 */
		setDeliveryDate : function(deliveryDate){
			_setDeliveryDate(deliveryDate);
		},

		/**
		 * @param	Number	amount
		 */
		setAmount : function(amount){
			_setAmount(amount);
		},

		/**
		 * @param	String	paper
		 */
		setPaper : function(paper){
			_setPaper(paper);
		},

		/**
		 * @param	Number	weight
		 */
		setWeight : function(weight){
			_setWeight(weight);
		},

		/**
		 * @param	String	machine
		 */
		setMachine : function(machine){
			_setMachine(machine);
		},

		/**
		 * @param	String	termination
		 */
		setTermination : function(termination){
			_setTermination(termination);
		},

		/**
		 * @return	Number
		 */
		getId : function(){
			return _getId();
		},

		/**
		 * @return	Number
		 */
		getDate : function(){
			return _getDate();
		},

		/**
		 * @return	Customer
		 */
		getCustomer : function(){
			return _getCustomer();
		},

		/**
		 * @return	String
		 */
		getDescription : function(){
			return _getDescription();
		},

		/**
		 * @return	String
		 */
		getState : function(){
			return _getState();
		},

		/**
		 * @return	Number
		 */
		getTotal : function(){
			return _getTotal();
		},

		/**
		 * @return	Number
		 */
		getAdvance : function(){
			return _getAdvance();
		},

		/**
		 * @return	String
		 */
		getDeliveryDate : function(){
			return _getDeliveryDate();
		},

		/**
		 * @return	Number
		 */
		getAmount : function(){
			return _getAmount();
		},

		/**
		 * @return	String
		 */
		getPaper : function(){
			return _getPaper();
		},

		/**
		 * @return	Number
		 */
		getWeight : function(){
			return _getWeight();
		},

		/**
		 * @return	String
		 */
		getMachine : function(){
			return _getMachine();
		},

		/**
		 * @return	String
		 */
		getTermination : function(){
			return _getTermination();
		},

		/**
		 * @return	JSON
		 */
		convertToArray : function(){
			return _convertToArray();
		}
	};
};