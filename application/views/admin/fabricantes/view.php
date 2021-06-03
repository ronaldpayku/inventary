<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Descripcion</th>
					<td><?php echo $fabricante->nombre; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $fabricante->estado == 1 ? "Activo":"Inactivo"; ?></td>
				</tr>
				
			</tbody>
		</table>
		<div class="row">
			<div class="col-md-6">
				Firma Autorizada: ________________
			</div>
			<div class="col-md-6">
				Firma Usuario: _____________
			</div>
		</div>
	</div>
</div>
