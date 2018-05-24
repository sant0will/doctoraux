@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Editor de Cidadãos</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			@if(session()->has('success'))
				@if(session()->get('success'))
					<div class="callout callout-success">
						{{ session()->get('success') }}
					</div>
				@endif
			@elseif(session()->has('error'))
				@if(session()->get('error')) 
					<div class="callout callout-danger">
						{{ session()->get('error') }}
					</div>
				@endif
			@endif
			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3 class="box-title">Dados do cidadão
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{action('CidadaoController@update', $cidadao->id)}}">
					@csrf
					<input name="_method" type="hidden" value="PATCH">
					
					<div class="box-body">

						<div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
							@if($cidadao->Type == 1)
								<label for="cpf" class="col-sm-2 control-label">CPF</label>
							@else
								<label for="cpf" class="col-sm-2 control-label">CNPJ</label>
							@endif
							<div class="col-sm-10">
								<input type="text" class="form-control" id="cpfcnpj" value="{{ $cidadao->cpfcnpj }}" placeholder="" minlength="11" maxlength="20" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }}">
							<label for="nome" class="col-sm-2 control-label">Nome completo *</label>
							<div class="col-sm-10">
							<input type="text" class="form-control" name="nome" value="{{ $cidadao->nome }}" placeholder="" minlength="7" maxlength="50" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="email" id="email" value="{{ $cidadao->email }}" placeholder="" minlength="7" maxlength="50">
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('telefone1') ? 'has-error' : '' }}">
							<label for="telefone1" class="col-sm-2 control-label">Telefone 1 *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="telefone1" id="telefone1" value="{{ $cidadao->telefone1 }}" placeholder="" minlength="10" maxlength="15" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('telefone2') ? 'has-error' : '' }}">
							<label for="telefone2" class="col-sm-2 control-label">Telefone 2</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="telefone2" id="telefone2" value="{{ $cidadao->telefone2 }}" placeholder="" minlength="10" maxlength="15">
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('inscricao') ? 'has-error' : '' }}">
							<label for="inscricao" class="col-sm-2 control-label">Inscrição Estadual de Produtor Rural</label>
							<div class="col-sm-10">
								<input type="inscricao" class="form-control" id="inscricao" value="{{ $cidadao->inscricao_prod_rural }}" placeholder="" minlength="7" maxlength="50" readonly>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('horas') ? 'has-error' : '' }}">
							<label for="horas" class="col-sm-2 control-label">Horas de Serviço Comsumidas</label>
							<div class="col-sm-10">
								<input type="horas" class="form-control" id="horas" value="{{ $cidadao->horas_servico }}" placeholder="" minlength="7" maxlength="50" readonly>
							</div>
						</div>
										
						<div class="box-footer">						 
							<button type="submit" class="btn-submit btn btn-primary pull-right" id="btn-submit" disabled>Salvar</button>
							<a href="/cidadaos" class="btn-cancel pull-right">Cancelar</a>
						</div>
					</div>
				</form>
					<div class="box-body">
						<div class="box-footer with-border pull-right">						
							<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-endereco" onclick="submitEndereco()"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Endereço</button>					
						</div>
						<div id="alert-endereco">
							<p class="text-light-blue pull-right alert"> * Insira ao menos um endereço para realizar o cadastro.  </p>
						</div>
						<table class="table table-condensed">
							<tr>
								<th>Logradouro</th>
								<th>Numero</th>
								<th>CEP</th>
								<th>Bairro</th>
								<th>Cidade</th>
								<th>Estado</th>
								<th>Complemento</th>
								<th>Ações</th>
							</tr>
							@foreach($enderecos as $endereco)
								<tr>
									<td id="td-logradouro">{{$endereco->logradouro}}</td>
									<td id="td-numero">{{$endereco->numero}}</td>
									<td id="td-cep">{{$endereco->cep}}</td>
									<td id="td-bairro">{{$endereco->bairro}}</td>
									<td id="td-cidade">{{$endereco->cidade}}</td>
									<td id="td-estado">{{$endereco->estado}}</td>
									<td id="td-complemento">{{$endereco->complemento == null ? 'Sem Complemento' : $endereco->complemento}}</td>
									<td>
										<a type="button" class="btn-modal-edit btn-sm bg-yellow" id="btn-modal-edit" href="/enderecos/{{$endereco->id}}/edit"> 
											<i class="fa-tables fa fa-pencil" aria-hidden="true"></i>Editar
										</a>
										<a type="button" class="btn-modal btn-sm bg-red" href="" id="btn-modal" data-endereco-id="{{$endereco->id}}" data-toggle="modal" data-target="#modal-default">
											<i class="fa-tables fa fa-trash" aria-hidden="true"></i>Excluir
										</a>                                           
										<div class="modal fade" id="modal-default">
											<div class="modal-dialog">
												<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title">Confirmação</h4>
												</div>
												<div class="modal-body">
													<p>Deseja realmente excluir o endereço?</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
													<form class="formdelete" name="formdelete" method="POST">
														@csrf
														@method('DELETE')                                         
														<button type="submit" class="btn btn-primary">Excluir</button>
													</form>
												</div>
												</div>
											</div>
										</div>   

									</td>
								</tr>
							@endforeach
						</table>
					</div>
					<div class="box-footer">
							<a href="/cidadaos" type="button" class="btn btn-primary pull-left"> <i class="fa-back fa fa-chevron-left" aria-hidden="true"></i>Voltar</a>                        
						</div>
					<div class="modal fade" id="modal-endereco">	
						<form class="form-horizontal" method="post" action="{{url('/enderecos')}}">	
							@csrf						
							<div class="modal-dialog modal-lg vertical-align-center">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Criação de Endereço
											<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
										</h4>
									</div>
									<div class="modal-body">											
										<div class="form-group has-feedback {{ $errors->has('cep') ? 'has-error' : '' }}">
											<label for="cep" class="col-sm-2 control-label">CEP *</label>
											<div class="cep col-sm-10">
												<input type="text" onchange="verifyCep()" class="form-control" name="cep" id="cep" minlength="8" maxlength="9" required>
											</div>
										</div>
				
										<div class="form-group has-feedback {{ $errors->has('estado') ? 'has-error' : '' }}">
											<label for="estado" class="col-sm-2 control-label">Estado *</label>
											<div class="col-sm-10">
												<select id="estado" class="form-control" name="estado" required>
													<option value="" selected>--- Escolha um estado ---</option>
													@foreach($estados as $estado)
														<option estado-uf="{{ $estado->uf }}" value="{{ $estado->nome }}">{{$estado->nome}}</option>
													@endforeach
												</select>
											</div>
										</div>
				
										<div class="form-group has-feedback {{ $errors->has('cidade') ? 'has-error' : '' }}">
											<label for="cidade" class="col-sm-2 control-label">Cidade *</label>
											<div class="col-sm-10">
												<select id="cidade" class="form-control" name="cidade" required>
													<option value="" selected>--- Escolha uma cidade ---</option>
													@foreach($cidades as $cidade)
														<option cidade-uf="{{ $cidade->uf }}" value="{{ $cidade->nome }}">{{$cidade->nome}}</option>
													@endforeach
												</select>
											</div>
										</div>
				
										<div class="form-group has-feedback {{ $errors->has('bairro') ? 'has-error' : '' }}">
											<label for="bairro" class="col-sm-2 control-label">Bairro *</label>
				
											<div id="bairro-div-select" class="col-sm-10" hidden>
												<select class="form-control" name="bairro" id="bairro-select" required>
													<option value="" selected>--- Escolha um bairro ---</option>
													@foreach($bairros as $bairro)
														<option value="{{ $bairro->nome }}">{{$bairro->nome}}</option>
													@endforeach
												</select>
											</div>
				
											<div id="bairro-div-input" class="col-sm-10" >
												<input type="text" class="form-control" name="bairro" id="bairro-input" placeholder="" minlength="3" maxlength="90">
											</div>
				
										</div>
				
										<div class="form-group has-feedback {{ $errors->has('logradouro') ? 'has-error' : '' }}">
											<label for="logradouro" class="col-sm-2 control-label">Logradouro *</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="logradouro" id="logradouro" placeholder="" minlength="3" maxlength="90" required>
											</div>
										</div>
				
										<div class="form-group has-feedback {{ $errors->has('numero') ? 'has-error' : '' }}">
											<label for="numero" class="col-sm-2 control-label">Número *</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="numero" id="numero" placeholder="" maxlength="6" required>
											</div>
										</div>
				
										<div class="form-group has-feedback {{ $errors->has('complemento') ? 'has-error' : '' }}">
											<label for="complemento" class="col-sm-2 control-label">Complemento</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="complemento" id="complemento" placeholder="" maxlength="90">
											</div>
										</div>
										<input type="text" name="cidadao_id" id="cidadao_id" value="{{$cidadao->id}}" readonly hidden>

									</div>
									<div class="modal-footer">																			                                            
										<button type="submit" class="btn btn-primary pull-right" onclick="addItems()">Salvar</button>	
										<a href="" data-dismiss="modal" class="btn-cancel pull-right">Cancelar</a>										
									</div>
								</div>
							</div>
						</form>	
					</div>		
				</form>
			</div>
		</div>
	</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

	{{-- Filtra seleção de cidades a partir dos estados --}}
	<script>
		var bairroselect = document.getElementById("bairro-select");
		var bairroinput = document.getElementById("bairro-input");
		var cidadesoptions = $('#cidade option');

		function verifyCep() {
			var cep = document.getElementById("cep").value;
			if(cep == '89560-000'){
				$("#estado").val("Santa Catarina").change();
				$("#cidade").val("Videira").change();
			}
		}

		$("#estado").on('change', function() {
			//var estado = $(this).find('option:selected').val();
			var estado_uf = $(this).find('option:selected').attr("estado-uf");
			//console.log("estado: "+estado_uf);

			var cidades = cidadesoptions;
			var newSelect = cidades.filter(function () {
				return $(this).attr('cidade-uf') == estado_uf;
			})

			$('#cidade').html(newSelect);
		});

		$("#cidade").on('change', function() {
			var cidade = $(this).find('option:selected').val();
			//var cidade_uf = $(this).find('option:selected').attr("cidade-uf");
			//console.log("cidade: "+cidade);

			// if(cidade == 'Videira') {
			// 	bairroselect.style.display = "block";
			// 	bairroinput.style.display = "none";
			// }else {
			// 	bairroselect.style.display = "none";
			// 	bairroinput.style.display = "block";
			// }

			if(cidade == 'Videira') {
				$("#bairro-div-select").css("display","block");
				$("#bairro-select").prop("disabled", false);
				
				$("#bairro-div-input").css("display","none");
				$("#bairro-input").prop("disabled", true);
			}else {
				$("#bairro-div-select").css("display","none");
				$("#bairro-select").prop("disabled", true);
				
				$("#bairro-div-input").css("display","block");
				$("#bairro-input").prop("disabled", false);
			}
		});

		window.onload = function () {

			$("#bairro-div-select").css("display","none");
			$("#bairro-select").prop("disabled", true);
			
			$("#bairro-div-input").css("display","block");
			$("#bairro-input").prop("disabled", false);

			//console.log("teste");
			var estado_uf = $("#estado").find('option:selected').attr("estado-uf");

			var cidades = cidadesoptions;
			var newSelect = cidades.filter(function () {
				return $(this).attr('cidade-uf') == estado_uf;
			})

			$('#cidade').html(newSelect);

			var verify = $("#td-logradouro").text();
			//console.log(verify);
			if(verify != ""){
				document.getElementById("btn-submit").disabled = false;
				$("#alert-endereco").css("display","none");
			}
		}

	</script>

	{{-- Mascara de conteudo --}}
	<script>
		jQuery(function ($) {
			$("#telefone1").mask("(99) 9999-99999");
			$("#telefone2").mask("(99) 9999-99999");
			$("#cep").mask("99999-999");
			$("#numero").mask("99999");
			$("#horas").mask('AAA:ZA', { reverese:true,
				'translation': {
				A: {pattern: /[0-9]/},
				Z: {pattern: /[0-5]/},
				}, 
			});
		});
	</script>
	<script>
		$('.btn-modal').click(function(){
			var id = $(this).data('endereco-id');
			console.log(id); 
			$(".formdelete").attr('action', ("/enderecos/"+id));
		})
	</script>	
@stop

