<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Descripción</th>
					<td><?php echo $sistema->descripcion; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $sistema->estado == 1 ? "Activo":"Inactivo"; ?></td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
