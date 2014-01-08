$(document).ready(function() {
			 $('a.delete').click(function(event) {
				var message = 'Esta seguro que desea eliminar un precio?';
				if (!confirm(message)) {
					event.preventDefault();
				}
			});
		});