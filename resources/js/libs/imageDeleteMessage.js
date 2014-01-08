$(document).ready(function() {
			 $('a.delete').click(function(event) {
				var message = 'Esta accion eliminara la Imagen. Desea Continuar?';
				if (!confirm(message)) {
				event.preventDefault();
				}
			});
		});