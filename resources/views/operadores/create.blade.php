@extends('adminlte::page')

@section('title')

@section('content_header')
    <p class="header-title">Cadastro de Operadores</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados do operador
						<br><small>Os campos com o símbolo (*) são obrigatórios.</small>
					</h3>
				</div>
				
				<form class="form-horizontal" method="post" action="{{url('/operadores')}}">
					@csrf
			
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">

                        <div class="form-group has-feedback {{ $errors->has('cidadao') ? 'has-error' : '' }}">
                            <label for="cidadao" class="col-sm-2 control-label">Cidadão *</label>
                            <div class="col-sm-10">
                                <select id="cidadao" class="form-control" name="cidadao" required>
                                    <option value="" selected>--- Escolha um cidadão ---</option>
                                    @foreach($cidadaos as $cidadao)
                                        <option @if(old('cidadao') == $cidadao->id) selected @endif value="{{ $cidadao->id }}">{{$cidadao->nome}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cidadao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('cidadao')[0] }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback {{ $errors->has('codigo_operador') ? 'has-error' : '' }}">
							<label for="codigo_operador" class="col-sm-2 control-label">Código do operador *</label>
							<div class="col-sm-10">
                                <input type="emais" class="form-control" value="{{old('codigo_operador')}}" name="codigo_operador" id="codigo_operador" placeholder="" minlength="1" maxlength="45" required>
                                @if ($errors->has('codigo_operador'))
                                    <span class="help-block">
                                        <strong>{{ $errors->get('codigo_operador')[0] }}</strong>
                                    </span>
                                @endif
							</div>
                        </div>                                      
					
					</div>

					<div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                        <a href="/operadores" data-dismiss="modal" class="btn-cancel pull-right">Cancelar</a>
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

@stop

