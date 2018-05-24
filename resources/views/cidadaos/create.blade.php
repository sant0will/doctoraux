@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Cadastro de Cidadãos</p>
@stop

@section('content')


    <div class="row" id="tudo">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do cidadão
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{url('/cidadaos')}}">
					@csrf

					<div class="box-body">
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

						<div class="form-group has-feedback {{ $errors->has('Type') ? 'has-error' : '' }}">
							<label class="col-sm-2 control-label">Type de Pessoa *</label>
							<div class="col-sm-10">
									<label class="radio-inline">
										<input type="radio" name="TypePessoa" id="TypePessoa1" value="1" onchange="verifyTypePessoa()" checked>
										Fisíca 
									</label>
									<label class="radio-inline">
										<input type="radio" name="TypePessoa" id="TypePessoa2" value="2" onchange="verifyTypePessoa()">
										Jurídica
									</label>
							</div>
						</div>

						<div id="nomecpf" class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}" >
							<label for="cpf"  class="col-sm-2 control-label">CPF *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cpf" id="cpf" placeholder="" minlength="11" maxlength="14" value="{{count($cidadao_data) >= 6 ? $cidadao_data[1] : old('cpfcnpj')}}" >
							</div>
							@if ($errors->has('cpf'))
								<span class="help-block">
									<strong>{{ $errors->get('cpf')[0] }}</strong>
								</span>
							@endif
						</div>

						<div id="nomecnpj" class="form-group has-feedback {{ $errors->has('cnpj') ? 'has-error' : '' }}" >
							<label for="cnpj" class="col-sm-2 control-label">CNPJ *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="" minlength="18" maxlength="18" value="{{count($cidadao_data) >= 6 ? $cidadao_data[1] : old('cpfcnpj')}}" >
							</div>
							@if ($errors->has('cnpj'))
								<span class="help-block">
									<strong>{{ $errors->get('cnpj')[0] }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }}">
							<label for="nome" class="col-sm-2 control-label">Nome completo *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nome" id="nome" placeholder="" minlength="7" maxlength="50" value="{{count($cidadao_data) >= 6 ? $cidadao_data[0] : old('nome')}}" required>
							</div>
							@if ($errors->has('nome'))
								<span class="help-block">
									<strong>{{ $errors->get('nome')[0] }}</strong>
								</span>
							@endif
						</div>
	
						<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email" class="col-sm-2 control-label">Email  </label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="email" id="email" placeholder="" minlength="7" maxlength="50" value="{{count($cidadao_data) >= 6 ? $cidadao_data[2] : old('email')}}">
							</div>
							@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->get('email')[0] }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group has-feedback {{ $errors->has('telefone1') ? 'has-error' : '' }}">
							<label for="telefone1" class="col-sm-2 control-label">Telefone 1 *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="telefone1" id="telefone1" placeholder="" minlength="10" maxlength="15" value="{{count($cidadao_data) >= 6 ? $cidadao_data[3] : old('telefone1')}}" required>
							</div>
							@if ($errors->has('telefone1'))
								<span class="help-block">
									<strong>{{ $errors->get('telefone1')[0] }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group has-feedback {{ $errors->has('telefone2') ? 'has-error' : '' }}">
							<label for="telefone2" class="col-sm-2 control-label">Telefone 2  </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="telefone2" id="telefone2" placeholder="" minlength="10" maxlength="15" value="{{count($cidadao_data) >= 6 ? $cidadao_data[4] : old('telefone2')}}">
							</div>
							@if ($errors->has('telefone2'))
								<span class="help-block">
									<strong>{{ $errors->get('telefone2')[0] }}</strong>
								</span>
							@endif
						</div>	

						<div class="form-group has-feedback {{ $errors->has('inscricao') ? 'has-error' : '' }}">
							<label for="inscricao" class="col-sm-2 control-label">Inscrição Estadual de Produtor Rural *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="inscricao" id="inscricao" placeholder="" minlength="9" maxlength="9" value="{{count($cidadao_data) >= 6 ? $cidadao_data[5] : old('inscricao')}}" required>
							</div>
							@if ($errors->has('inscricao'))
								<span class="help-block">
									<strong>{{ $errors->get('inscricao')[0] }}</strong>
								</span>
							@endif
						</div>	

						<div class="form-group has-feedback {{ $errors->has('horas') ? 'has-error' : '' }}">
							<label for="horas" class="col-sm-2 control-label"> Horas de Serviço Comsumidas *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="horas" id="horas" placeholder="" minlength="6" maxlength="6" value="{{ count($cidadao_data) >= 6 ? $cidadao_data[6] : old('horas') }}" required>								
							</div>
							@if ($errors->has('horas'))
								<span class="help-block">
									<strong>{{ $errors->get('horas')[0] }}</strong>
								</span>
							@endif
						</div>				

						<div class="box-footer">						 
							<button type="submit" class="btn-submit btn btn-primary pull-right" id="btn-submit" disabled>Salvar</button>
							<a href="/cidadaos" class="btn-cancel pull-right">Cancelar</a>
						</div>
					<button type="button" name="verify-input" id="verify-input" value="{{$salvo}}" hidden readonly>
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
							@foreach($enderecost as $enderecot)
							 <input id="key-form" value={{$enderecot->key_session}} hidden readonly>
								<tr>
									<td id="column-tb">{{$enderecot->logradouro}}</td>
									<td>{{$enderecot->numero}}</td>
									<td>{{$enderecot->cep}}</td>
									<td>{{$enderecot->bairro}}</td>
									<td>{{$enderecot->cidade}}</td>
									<td>{{$enderecot->estado}}</td>
									<td>{{$enderecot->complemento == null ? 'Sem Complemento' : $enderecot->complemento}}</td>
									<td>
										<a type="button" class="btn-sm bg-yellow" href="/enderecosTemp/{{$enderecot->id}}/edit" > 
											<i class="fa-tables fa fa-pencil" aria-hidden="true"></i>Editar
										</a>
										<a type="button" class="btn-modal btn-sm bg-red" href="" id="btn-modal" data-enderecot-id="{{$enderecot->id}}" data-toggle="modal" data-target="#modal-default">
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
					<div class="modal fade" id="modal-endereco">	
						<form class="form-horizontal" method="post" action="{{url('/enderecosTemp')}}">	
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
												<input type="text" class="form-control" name="logradouro" placeholder="" minlength="3" maxlength="90" required>
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
												<input type="text" class="form-control" name="complemento" placeholder="" maxlength="90">
											</div>
										</div>
										<input type="text" name="data_nome" id="data_nome" value="" hidden readonly>
										<input type="text" name="data_cpf" id="data_cpf" value="" hidden readonly>
										<input type="text" name="data_cnpj" id="data_cnpj" value="" hidden readonly>
										<input type="text" name="data_email" id="data_email" value="" hidden readonly>
										<input type="text" name="data_telefone1" id="data_telefone1" value="" hidden readonly>
										<input type="text" name="data_telefone2" id="data_telefone2" value="" hidden readonly>
										<input type="text" name="data_inscricao" id="data_inscricao" value="" hidden readonly>
										<input type="text" name="data_horas" id="data_horas" value="" hidden readonly>
										
									</div>
									<div class="modal-footer">																			                                            
										<button type="submit" class="btn btn-primary pull-right">Salvar</button>	
										<a href="" data-dismiss="modal" class="btn-cancel pull-right">Cancelar</a>										
									</div>
								</div>
							</div>
						</form>	
					</div>											
				</div>		
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
		function verifyTypePessoa(){
			var Type = document.querySelector('input[name="TypePessoa"]:checked').value;
			if(Type == 1){
				$("#nomecpf").css("display","block");
				$("#nomecnpj").css("display","none");
				$("#cnpj").val("");
				$("#cpf").prop("required", true);
				$("#cnpj").prop("required", false);
				$("#cpf").prop("disabled", false);
				$("#cnpj").prop("disabled", true);
			}else if(Type == 2){
				$("#nomecpf").css("display","none");
				$("#nomecnpj").css("display","block");
				$("#cpf").val("");
				$("#cnpj").prop("required", true);
				$("#cpf").prop("required", false);
				$("#cpf").prop("disabled", true);
				$("#cnpj").prop("disabled", false);
			}
		}

		function submitEndereco(){
			var nome = $("#nome").val();
			var cpf = $("#cpf").val();
			var cnpj = $("#cnpj").val();
			var email = $("#email").val();
			var tel1 = $("#telefone1").val();
			var tel2 = $("#telefone2").val();
			var horas = $("#horas").val();
			var inscricao = $('#inscricao').val();

			$("#data_nome").val(nome);
			$("#data_cpf").val(cpf);
			$("#data_cnpj").val(cnpj);
			$("#data_email").val(email);
			$("#data_telefone1").val(tel1);
			$("#data_telefone2").val(tel2);
			$("#data_horas").val(horas);
			$("#data_inscricao").val(inscricao);
		}
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

			if(estado_uf == 'SC'){
				$("#cidade").val("Videira").change();
			}
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

			var verify = $("#column-tb").text();
			//console.log(verify);
			if(verify != ""){
				document.getElementById("btn-submit").disabled = false;
				$("#alert-endereco").css("display","none");
			}
			verifyTypePessoa();

		}

	</script>

	{{-- Mascara de conteudo --}}
	<script>
		jQuery(function ($) {
			$("#telefone1").mask("(99) 9999-99999");
			$("#telefone2").mask("(99) 9999-99999");
			$("#cpf").mask('000.000.000-00', {reverse: true});
			$("#cnpj").mask('00.000.000/0000-00', {reverse: true});
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
			$(".formdelete").attr('action', ("/enderecosTemp/"+id));
			console.log(document.getElementById(""));
		})
	</script>	
@stop

