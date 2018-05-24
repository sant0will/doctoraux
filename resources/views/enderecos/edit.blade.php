@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Cadastro de Endereço</h1>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do endereço</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{action('EnderecoController@update', $endereco->id)}}">
					@csrf
					<input name="_method" type="hidden" value="PATCH">

					<div class="box-body">

						<div class="form-group has-feedback {{ $errors->has('cep') ? 'has-error' : '' }}">
							<label for="cep" class="col-sm-2 control-label">CEP</label>
							<div class="cep col-sm-10">
								<input type="text" onchange="verifyCep()" class="form-control" name="cep" id="cep" value="{{ $endereco->cep }}" minlength="8" maxlength="9" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('estado') ? 'has-error' : '' }}">
							<label for="estado" class="col-sm-2 control-label">Estado</label>
							<div class="col-sm-10">
								<select id="estado" class="form-control" name="estado" required>
									<option value="{{ $endereco->estado }}" selected>{{ $endereco->estado }}</option>
									@foreach($estados as $estado)
										<option estado-uf="{{ $estado->uf }}" value="{{ $estado->nome }}">{{$estado->nome}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('cidade') ? 'has-error' : '' }}">
							<label for="cidade" class="col-sm-2 control-label">Cidade</label>
							<div class="col-sm-10">
								<select id="cidade" class="form-control" name="cidade" required>
									<option value="{{ $endereco->cidade }}" selected>{{ $endereco->cidade }}</option>
									@foreach($cidades as $cidade)
										<option cidade-uf="{{ $cidade->uf }}" value="{{ $cidade->nome }}">{{$cidade->nome}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('bairro') ? 'has-error' : '' }}">
							<label for="bairro" class="col-sm-2 control-label">Bairro</label>

							<div id="bairro-div-select" class="col-sm-10" hidden>
								<select class="form-control" name="bairro" id="bairro-select">
									<option value="{{ $endereco->bairro }}" selected>{{ $endereco->bairro }}</option>
									@foreach($bairros as $bairro)
										<option value="{{ $bairro->nome }}">{{$bairro->nome}}</option>
									@endforeach
								</select>
							</div>

							<div id="bairro-div-input" class="col-sm-10" >
								<input type="text" class="form-control" name="bairro" id="bairro-input" value="{{ $endereco->bairro }}" placeholder="" minlength="3" maxlength="90">
							</div>

						</div>

						<div class="form-group has-feedback {{ $errors->has('logradouro') ? 'has-error' : '' }}">
							<label for="logradouro" class="col-sm-2 control-label">Logradouro</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="logradouro" value="{{ $endereco->logradouro }}" placeholder="" minlength="3" maxlength="90" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('numero') ? 'has-error' : '' }}">
							<label for="numero" class="col-sm-2 control-label">Número</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="numero" id="numero" value="{{ $endereco->numero }}" placeholder="" maxlength="6">
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('complemento') ? 'has-error' : '' }}">
							<label for="complemento" class="col-sm-2 control-label">Complemento</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="complemento" value="{{ $endereco->complemento }}" placeholder="" maxlength="90">
							</div>
						</div>
					
					</div>

					<div class="box-footer">						 
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>
						<a href="/cidadaos/create" class="btn-cancel pull-right">Cancelar</a>
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
		}

	</script>

	{{-- Mascara de conteudo --}}
	<script>
		jQuery(function ($) {
			$("#cep").mask("99999-999");
			$("#numero").mask("99999");
		});
	</script>
@stop

