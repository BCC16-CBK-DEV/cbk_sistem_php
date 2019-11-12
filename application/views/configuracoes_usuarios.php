<?php
include "header.php";
include "scripts.php";
?>

<div class="posicao_conteudo">
	<h4 class="titulo_opcoes"><span class="fa fa-user"></span> Usuários</h4>
	<hr class="linha_nova_ordem">
	<div class="centraliza">
		<div class="barra_pesquisa row">
			<button class="btn btn-dark botoesBarra" id="botaoFiltro" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFiltro">
				<span class="fa fa-search"></span> Filtros
			</button>
			<a class="btn btn-dark botoesBarra2" id="botaoNovoUsuario" >
				<span class="fa fa-plus-circle"></span> Novo Usuário
			</a>
			<a class="btn btn-dark botoesBarra" id="botaoInicio" href="<?php echo base_url();?>Configuracoes/index">
				<span class="fa fa-chevron-circle-left"></span> Voltar
			</a>
		</div>
		<div class="collapse row" id="collapseFiltro">
			<div class="card card-body">
				<form id="form_filtro_usuario" method="post" action="<?php echo base_url();?>Configuracoes/filtroUsuario">
				<div class="linha_filtro row">
					<div class="col-lg-7">
						<label>Nome Completo</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="text" class="form-control" aria-label="Nome Completo" aria-describedby="inputGroup-sizing-sm"
							id="filtro_nome_completo" name="filtro_nome_completo" value="<?php echo $this->input->get_post('filtro_nome_completo'); ?>">
						</div>
					</div>
					<div class="col-mb-5">
						<label>Usuário</label>
						<div class="input-group input-group-sm mb-3 ">
							<input type="text" class="form-control" aria-label="Usuário" aria-describedby="inputGroup-sizing-sm"
							id="filtro_nome_usuario" name="filtro_nome_usuario" value="<?php echo $this->input->get_post('filtro_nome_usuario'); ?>">
						</div>
					</div>
				</div>
				<div class="linha_filtro row">
					<div class="col-lg-5">
						<label>Departamento</label>
						<div class="input-group input-group-sm">
							<select id="filtro_departamento_usuario" name="filtro_departamento_usuario" class="form-control form-control-sm ">
								<option value="0">Selecionar Departamento</option>
								<?php
								foreach($departamento as $dep):
									echo '<option value="'.$dep['id_departamento'].'" '.($dep['id_departamento'] == $this->input->get_post('filtro_nome_usuario') ? 'selected':'' ).'>'.$dep['nome_departamento'].'</option>';
								endforeach;
								?>
							</select>
						</div>
					</div>
					<div class="col-mb-3">
						<label></label>
						<button class="btn btn-dark botao_filtro" id="botaoFiltro_buscar" type="submit">
							<span class="fa fa-search"></span> Buscar
						</button>
						<a class="btn btn-dark botao_filtro " href="<?php echo base_url(); ?>Configuracoes/usuarios" id="botaoFiltro_limpar">
							Limpar
						</a>
					</div>
				</div>
				</form>
			</div>
		</div>


		<div class="row">
			<table class="table tabela_os_abertas">
				<thead class="thead-dark">
				<tr>
					<th scope="col">ID do Usuário</th>
					<th scope="col">Nome Completo</th>
					<th scope="col">Usuário</th>
					<th scope="col">Departamento</th>
					<th scope="col">Ações</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach ($usuarios as $user):
					echo '<tr><th scope="row">' . $user['id_usuario'] . '</th>';
					echo '<td>'.$user['nome_completo'].'</td>';
					echo '<td>'.$user['nome_usuario'].'</td>';
					echo '<td>'.$user['nome_departamento'].'</td>';
					echo '<td><a class="botaoAcoesTabela botaoEditar" id="botaoAlterarOrdem" onclick="alterar_usuario('.$user['id_usuario'].');"><span class="fa fa-pencil-square-o"></span></a>
						<a class="botaoAcoesTabela botaoEditar" id="botaoExcluirOrdem" data-toggle="modal" data-target="#msgUsuarioExclusao" onclick="excluir_usuario('.$user['id_usuario'].');"><span class="fa fa-trash-o"></span></a></td></tr>';
				endforeach;?>
				</tbody>
			</table>
		</div>
	</div>


	<!-- MODAL PARA ADICIONAR USUARIO -->
	<div class="modal fade" id="AdicionarNovoUsuario"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Novo Usuário</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form id="formulario_novo_usuario" method="post" action="">
						<input type="hidden" class="form-control input-group-sm" id="id_peca" name="id_peca" >
						<label for="nome_completo" class="col-form-label">Nome Completo</label>
						<input type="text" class="form-control input-group-sm" id="nome_completo" name="nome_completo" required>

						<label for="nome_usuario" class="col-form-label">Usuário</label>
						<input type="text" class="form-control input-group-sm" id="nome_usuario" name="nome_usuario" required>

						<label for="senha" class="col-form-label">Senha</label>
						<input type="password" class="form-control input-group-sm" id="senha" name="senha">

						<label for="departamento" class="col-form-label">Departamento</label>
						<select id="departamento_usuario" name="departamento_usuario" class="form-control form-control-sm ">
							<option value="0">Selecionar Departamento</option>
							<?php
							foreach($departamento as $dep):
								echo '<option value="'.$dep['id_departamento'].'")>'.$dep['nome_departamento'].'</option>';
							endforeach;
							?>
						</select>
						<hr>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="botaoCancelar">Cancelar</button>
						<button type="submit" class="btn btn-success" id="botaoCadastrarUsuario">Cadastrar</button>
					</form>
				</div>
				<div class="modal-footer">
					<p class="help-block"></p>

				</div>

			</div>
		</div>
	</div>

	<!-- MENSAGEM DE NOVO USUÁRIO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgUsuarioCadastro">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="titulo_nova_peca">Novo Usuário</h5>
				</div>
				<div class="modal-body">
					<p id="msgNovoUsuario"></p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgOKNovoUsuario" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL PARA ALTERAR Peça -->
	<div class="modal fade" id="AlterarUsuario"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Alterar Usuário</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form id="formulario_alterar_usuario" method="post" >
						<input type="hidden" class="form-control input-group-sm" id="id_usuario_alterar" name="id_usuario_alterar" >
						<label for="nome_completo" class="col-form-label">Nome Completo</label>
						<input type="text" class="form-control input-group-sm" id="nome_completo_alterar" name="nome_completo_alterar" required>

						<label for="nome_usuario" class="col-form-label">Usuário</label>
						<input type="text" class="form-control input-group-sm" id="nome_usuario_alterar" name="nome_usuario_alterar" required>

						<label for="senha" class="col-form-label">Senha</label>
						<input type="password" class="form-control input-group-sm" id="senha_alterar" name="senha_alterar" placeholder="********">

						<label for="departamento_usuario" class="col-form-label">Departamento</label>
						<select id="departamento_usuario_alterar" name="departamento_usuario_alterar" class="form-control form-control-sm ">
							<option value="0">Selecionar Departamento</option>
							<?php
							foreach($departamento as $dep):
								echo '<option value="'.$dep['id_departamento'].'")>'.$dep['nome_departamento'].'</option>';
							endforeach;
							?>
						</select>
						<hr>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="botaoCancelarAlteracao">Cancelar</button>
						<button type="submit" class="btn btn-success" id="botaoAlterarUsuario">Alterar</button>
					</form>
				</div>
				<div class="modal-footer">
					<p class="help-block"></p>

				</div>

			</div>
		</div>
	</div>

	<!-- MENSAGEM EXCLUIR USUARIO -->
	<div class="modal" tabindex="-1" role="dialog" id="msgUsuarioExclusao">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Excluir Usuário</h5>
					<!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>-->
				</div>
				<div class="modal-body">
					<p>Deseja realmente excluir o Usuário Selecionado?</p>
				</div>
				<div class="modal-footer">
					<button type="button" id="msgOkExclusao" class="btn btn-danger" >SIM</button>
					<button type="button" id="" class="btn btn-primary" data-dismiss="modal">NÃO</button>
				</div>
			</div>
		</div>
	</div>

</div>
