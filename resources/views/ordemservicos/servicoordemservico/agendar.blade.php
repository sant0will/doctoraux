@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Agendamento de Serviços da Ordem</h1>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Agendar serviço</h3>
				</div>
				
				{{-- <form class="form-horizontal" method="post" action="{{url('/servico')}}">
                    @csrf --}}
                <form class="form-horizontal" method="post" action="{{action('ServicoOrdemServicoController@agenda')}}">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
			
					@if(session()->has('message'))
						<div class="callout callout-danger">
							{{ session()->get('message') }}
						</div>
					@endif           

					<div class="box-body">
                        
                        <div class="form-group has-feedback {{ $errors->has('data_programacao') ? 'has-error' : '' }}">
                            <label for="data_programacao" class="col-sm-2 control-label">Data programação</label>
                            <div class="col-sm-10">
                                <input type="emais" class="form-control" value="{{old('data_programacao')}}" name="data_programacao" id="data_programacao" placeholder="" minlength="8" maxlength="10" required>
                                @if ($errors->has('data_programacao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('data_programacao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback {{ $errors->has('hora_programacao') ? 'has-error' : '' }}">
                            <label for="hora_programacao" class="col-sm-2 control-label">Hora programação</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{old('hora_programacao')}}" name="hora_programacao" id="hora_programacao" placeholder="" minlength="8" maxlength="10" required>
                                @if ($errors->has('hora_programacao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hora_programacao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group has-feedback {{ $errors->has('maquinas') ? 'has-error' : '' }}">
                            <label for="maquinas" class="col-sm-2 control-label">Maquinas</label>
                            <div class="col-sm-10">
                                <select class="form-control" tabindex="-1" aria-hidden="true" id="selectmaquinas" onchange="newSelect()" required>
                                    @foreach($maquinas as $maquina)
                                        <option @if(old('maquinas') == $maquina->id) selected @endif value="{{ $maquina->id }}">{{ $maquina->descricao }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('maquinas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('maquinas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="text" id="maquinas" name="maquinas" class="maquinas" value="" required readonly hidden>

                        <input type="text" name="idservico" value="{{$idservico}}" required readonly hidden>
                        <input type="text" name="idordem" value="{{$idordem}}" required readonly hidden>
					
					</div>

					<div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Salvar</button>	
                        <a href="/ordemservico/{{$idordem}}/ordem" class="btn-cancel pull-right">Cancelar</a>				
					</div>

				</form>
			</div>
		</div>
	</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
    {{-- <style> .table-condensed > thead { display:none; } .table-condensed { width:100%; } </style> --}}
@stop

@section('js')
    <script>
        (function($){
            $.fn.datetimepicker.dates['pt-BR'] = {
                days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
                daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
                daysMin: ["D", "S", "T", "Q", "Q", "S", "S", "D"],
                months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                today: "Hoje",
                format: 'dd/mm/yyyy',
                suffix: [],
		        meridiem: []
            };
        }(jQuery));
    </script>
    <script>
        $(function() {
            $('#data_programacao').datetimepicker({
                language: 'pt-BR',
                pickTime: false,
                //format: 'dd/mm/yyyy',
                autoclose: true,
                minView: 2,
                startDate: new Date(),
            });
        });
    </script>
    <script>
        $(function() {
            $('#hora_programacao').datetimepicker({
                //language: 'pt-BR',
                formatViewType: 'time',
                pickDate: false,
                minuteStep: 15,
                pickerPosition: 'bottom-right',
                format: 'HH:ii p',
                autoclose: true,
                showMeridian: true,
                startView: 1,
                maxView: 1,
            });
            // }).on("show", function(){
            //         $(".table-condensed .prev").css('visibility', 'hidden');
            //         $(".table-condensed .switch").text("Hora");
            //         $(".table-condensed .next").css('visibility', 'hidden');
            //     });
        });
    </script>

    {{-- Seleção multipla --}}
    <script>
        $(document).ready(function() { 
            $("#selectmaquinas").select2({
                multiple: true,
                placeholder: "--- Selecione as máquinas deste serviço ---",

            });
        });

        window.onload = function () {
            $("#selectmaquinas").val("");
        }
    </script>
    <script>
        function newSelect(){
            var select = $("#selectmaquinas").val();   
            //console.log(select);        
            $("#maquinas").val(select);  
            console.log($("#maquinas").val());         
        }
    </script>
    {{-- Fim seleção multipla --}}
@stop

