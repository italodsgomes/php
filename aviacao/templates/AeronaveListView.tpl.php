<?php
	$this->assign('title','AVIACAO | Aeronaves');
	$this->assign('nav','aeronaves');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/aeronaves.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		

		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Aeronaves
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>


	<script type="text/template" id="aeronaveCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_IdCliente">Id Cliente<% if (page.orderBy == 'IdCliente') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Matricula">Matricula<% if (page.orderBy == 'Matricula') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Modelo">Modelo<% if (page.orderBy == 'Modelo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Ano">Ano<% if (page.orderBy == 'Ano') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>

			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('idCliente') || '') %></td>
				<td><%= _.escape(item.get('matricula') || '') %></td>
				<td><%= _.escape(item.get('modelo') || '') %></td>
				<td><%= _.escape(item.get('ano') || '') %></td>

			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>


	<script type="text/template" id="aeronaveModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="idClienteInputContainer" class="control-group">
					<label class="control-label" for="idCliente">Id Cliente</label>
					<div class="controls inline-inputs">
						<select id="idCliente" name="idCliente"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="matriculaInputContainer" class="control-group">
					<label class="control-label" for="matricula">Matricula</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="matricula" placeholder="Matricula" value="<%= _.escape(item.get('matricula') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="modeloInputContainer" class="control-group">
					<label class="control-label" for="modelo">Modelo</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="modelo" placeholder="Modelo" value="<%= _.escape(item.get('modelo') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="anoInputContainer" class="control-group">
					<label class="control-label" for="ano">Ano</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="ano" placeholder="Ano" value="<%= _.escape(item.get('ano') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="corInputContainer" class="control-group">
					<label class="control-label" for="cor">Cor</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="cor" placeholder="Cor" value="<%= _.escape(item.get('cor') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>


		<form id="deleteAeronaveButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteAeronaveButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Aeronave</button>
						<span id="confirmDeleteAeronaveContainer" class="hide">
							<button id="cancelDeleteAeronaveButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteAeronaveButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	
	<div class="modal hide fade" id="aeronaveDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Aeronave
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="aeronaveModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveAeronaveButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="aeronaveCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newAeronaveButton" class="btn btn-primary">Add Aeronave</button>
	</p>

</div> 

<?php
	$this->display('_Footer.tpl.php');
?>
