@extends('adminlte::page')

@section('title')

@section('content_header')
	<p class="header-title">Editor de Cidades</p>
@stop   

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do Cidades
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				<form class="form-horizontal" method="POST" action="{{action('CidadeController@update', $cidade->id)}}">
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
						<div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }}">
							<label for="nome" class="col-sm-2 control-label">Nome do Cidade *</label>
							<div class="col-sm-10">
                            <input type="text" class="form-control" name="nome" value="{{$cidade->nome}}" placeholder="" minlength="2" maxlength="45" required>
							</div>
						</div>

						<div class="form-group has-feedback {{ $errors->has('uf') ? 'has-error' : '' }}">
							<label for="uf" class="col-sm-2 control-label">Estado *</label>
							<div class="col-sm-10">
								<select id="uf" class="form-control" name="uf" required>
									@foreach($estados as $estado)
										@if($cidade->uf == $estado->uf)
											<option value="{{ $estado->uf }}" selected>{{ $estado->nome }}</option>
										@endif										
										<option value="{{ $estado->uf }}">{{$estado->nome}}</option>
									@endforeach
								</select>
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
		//Função para validação da uf ser apenas letras
		function validateUF(){
			var uf = document.getElementById("uf");
			if(Number(uf.value)){
				document.getElementById("return-validate").innerHTML = "Insira apenas letras.";
				uf.value = "";
			}else{
				uf.value = uf.value.uppercase();
			}
		}
	</script>
@stop

