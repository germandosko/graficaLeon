$(document).ready(function() {
			 $('a.delete').click(function(event) {
				var message = 'Esta accion eliminara el Cliente, el Historial de Pedidos\n';
				message += 'y Pagos de forma permanente. Desea continuar?\n';
				if (!confirm(message)) {
				event.preventDefault();
				}
			});
		});