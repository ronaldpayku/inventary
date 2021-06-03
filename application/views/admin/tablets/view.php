<div class="row">
	<div class="col-xs-12">
		<h2><strong>Codigo del Tablet : </strong> <?php echo $tablet->codigo; ?> </h2>
		<table class="table table-bordered">
			<tbody>
				
				
				<tr>
					<th style="background-color: #f4f4f4;">Fabricante</th>
					<td><?php echo $tablet->fabricante; ?></td>
				</tr>
				<tr>
					
					<th style="background-color: #f4f4f4;">Modelo</th>
					<td><?php echo $tablet->modelo; ?></td>
				</tr>
				
				<tr>
					<th style="background-color: #f4f4f4;">Descripción</th>
					<td><?php echo $tablet->descripcion; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $tablet->estado == 1 ? "Activo":"Inactivo"; ?></td>
				</tr>
				<tr>
					<th style="background-color: #3c8dbc; color: #FFF;" class="text-center" colspan="4">Ultimos Mantenimientos</th>
				</tr>
				<tr>
					<th>Fecha</th>
					<th>Técnico</th>
					<th colspan="2">Descripción</th>
				</tr>
				<?php if (!empty($mantenimientos)): ?>
					<?php foreach ($mantenimientos as $mantenimiento): ?>
						<tr>
							<td><?php echo $mantenimiento->fecha;?></td>
							<td><?php echo $mantenimiento->tecnico;?></td>
							<td colspan="2"><?php echo $mantenimiento->descripcion;?></td>
						</tr>
					<?php endforeach ?>
					
				<?php else: ?>
					<tr>
						<td colspan="4">No se ha realizo ningun mantenimiento</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
