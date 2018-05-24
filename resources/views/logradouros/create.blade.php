@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Cadastro de Logradouros</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do Logradouro
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{url('/logradouros')}}">
					@csrf
					@if(session()->has('message'))
						@if(session()->get('state'))
							<div class="callout callout-success">
								{{ session()->get('message') }}
							</div>
						@else
							<div class="callout callout-danger">
								{{ session()->get('message') }}
							</div>
						@endif
					@endif
					<div class="box-body">
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
					<div class="form-group has-feedback {{ $errors->has('Type') ? 'has-error' : '' }}">
							<label for="Type" class="col-sm-2 control-label">Type *</label>
							<div class="col-sm-10">
								<select id="Type" class="form-control" name="Type" required>
									<option value="" selected>--- Escolha um Type ---</option>
									@foreach($types as $Type)
										<option value="{{ $Type->nome }}">{{ $Type->nome }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group has-feedback {{ $errors->has('logradouro') ? 'has-error' : '' }}">
							<label for="logradouro" class="col-sm-2 control-label">Logradouro *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="logradouro" placeholder="" minlength="1" maxlength="100" required>
							</div>
						</div>

					</div>

					<div class="box-footer">						 
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>
						<a href="/logradouros" class="btn-cancel pull-right">Cancelar</a>
					</div>

					<div class="modal fade" id="modal-default">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Confirmação</h4>
							</div>
							<div class="modal-body">
								<p>Deseja realmente realizar as alterações feitas?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
								<button type="submit" class="btn btn-primary">Salvar</button>
							</div>
							</div>
						</div>
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
	<script>

		var bairroselect = document.getElementById("bairro-select");
		var bairroinput = document.getElementById("bairro-input");
		var cidadesoptions = $('#cidade option');

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
@stop

