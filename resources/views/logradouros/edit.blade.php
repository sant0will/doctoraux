@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Editor de Logradouros</p>
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
				<form class="form-horizontal" method="POST" action="{{action('LogradouroController@update', $logradouro->id)}}">
                     @csrf				
                    <input name="_method" type="hidden" value="PATCH">					
					@if(session()->has('success'))
                        @if(session()->get('success'))
                            <div class="callout callout-success">
                                {{ session()->get('success') }}
                            </div>
                        @else
                            <div class="callout callout-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                    @endif
					<div class="box-body">
							<div class="form-group has-feedback {{ $errors->has('estado') ? 'has-error' : '' }}">
							<label for="estado" class="col-sm-2 control-label">Estado *</label>
							<div class="col-sm-10">
								<select id="estado" class="form-control" name="estado" required>									
									@foreach($estados as $estado)
										@if($cidade_id->uf == $estado->uf)
											<option estado-uf="{{ $estado->uf }}" value="{{$estado->nome}}" selected>{{$estado->nome}}</option>
										@else
											<option estado-uf="{{ $estado->uf }}" value="{{ $estado->nome }}">{{$estado->nome}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('cidade') ? 'has-error' : '' }}">
							<label for="cidade" class="col-sm-2 control-label">Cidade *</label>
							<div class="col-sm-10">
								<select id="cidade" class="form-control" name="cidade" required>
									@foreach($cidades as $cidade)
										@if($cidade_id->nome == $cidade->nome)
											<option cidade-uf="{{ $cidade_id->uf }}" value="{{$cidade_id->nome}}" selected>{{$cidade_id->nome}}</option>
										@else
											<option cidade-uf="{{ $cidade->uf }}" value="{{ $cidade->nome }}">{{$cidade->nome}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
					<div class="form-group has-feedback {{ $errors->has('Type') ? 'has-error' : '' }}">
							<label for="Type" class="col-sm-2 control-label">Type *</label>
							<div class="col-sm-10">
								<select id="Type" class="form-control" name="Type" required>
									<option value="{{$logradouro->Type}}" selected>{{$logradouro->Type}}</option>
									@foreach($types as $Type)
										@if($logradouro->Type != $Type->nome)
											<option value="{{ $Type->nome }}">{{ $Type->nome }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group has-feedback {{ $errors->has('logradouro') ? 'has-error' : '' }}">
							<label for="logradouro" class="col-sm-2 control-label">Logradouro *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="logradouro" placeholder="" minlength="1" maxlength="100" value="{{$logradouro->logradouro}}" required>
							</div>
						</div>
					</div>

					<div class="box-footer">						 
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>
						<a href="/cidades" class="btn-cancel pull-right">Cancelar</a>
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

		window.onload = function () {
			//console.log("teste");
			var estado_uf = $("#estado").find('option:selected').attr("estado-uf");

			var cidades = cidadesoptions;
			var newSelect = cidades.filter(function () {
				return $(this).attr('cidade-uf') == estado_uf;
			})

			$('#cidade').html(newSelect);

			if(estado_uf == 'SC'){
				$("#cidade").val("Videira").change();
			}
		}
	</script>
@stop

