@extends('adminlte::page')

@section('title')

@section('content_header')
    <p class="header-title">Ordem de Serviço</p>
@stop

@section('content')

    <div class="row">
		<div class="col-md-10 col-md-offset-1">

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Dados da ordem</h3>
				</div>
				
				<form class="form-horizontal">        
					<div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cidadão</label>
                            <div class="col-sm-10">
                                <input name="cidadao" value="{{ $cidadao->id }}" required readonly hidden>
                                <input type="text" class="form-control" value="{{ $cidadao->nome }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Data e hora abertura ordem de serviço</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="data" value="{{ $ordemservico->data_abertura }}" readonly>
                            </div>
                        </div>

                        <div id="divhoras" class="form-group" hidden>
                            <label class="col-sm-2 control-label">Horas de serviço já utilizadas</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $horas_servico }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Setor</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="data" value="{{$setor->nome}}" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="observacao" class="col-sm-2 control-label">Observações</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="6" readonly>{{ $ordemservico->observacao }}</textarea>
                            </div>
                        </div>   
					
					</div>
				</form>
            </div>
            {{-- ./box --}}

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Serviços da ordem</h3>

                    <a href="/novoservico" class="btn btn-primary pull-right btn-cadastro-ordemservico"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Adicionar serviço</a>
                </div>
                
                <form class="form-horizontal">

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
                    @elseif(session()->has('warning'))
                        @if(session()->get('warning')) 
                            <div class="callout callout-warning">
                                {{ session()->get('warning') }}
                            </div>
                        @endif
                    @endif

                    <div class="box-body">
                        <table class="table table-condensed">
                            <tr>
                                <th>Serviço</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            @foreach($servicos_ordem as $so)
                                @foreach($servicos as $servico)
                                    @if($so->servico_id == $servico->id)
                                        <tr>
                                            <td>{{$servico->descricao}}</td>
                                            <td>
                                                <span 
                                                    @if($so->status == 7) class="label btn-warning" 
                                                    @elseif($so->status == 8) class="label btn-primary"
                                                    @elseif($so->status == 5) class="label btn-danger"
                                                    @elseif($so->status == 6) class="label btn-success"
                                                    @endif
                                                    >{{$status->find($so->status)->descricao}}
                                                </span>
                                            </td>
                                            <td>
                                                @if(!$so->agendado && $so->status != 5 && $so->status != 6)
                                                    <a type="button" href="/servico/{{$servico->id}}/{{$ordemservico->id}}/agendar" class="btn-sm btn-primary">
                                                        <i class="fa-tables fa fa-clock-o" aria-hidden="true"></i>Agendar
                                                    </a>
                                                @elseif($so->agendado && $so->status != 5 && $so->status != 6)
                                                    <a type="button" href="/servico/{{$servico->id}}/{{$ordemservico->id}}/executar" class="btn-sm btn-success">
                                                        <i class="fa-tables fa fa-check" aria-hidden="true"></i>Executado
                                                    </a>
                                                    <a type="button" class="btn-jus btn-modal btn-sm btn-warning" href="" data-id="0" data-servico-id="{{$servico->id}}" data-ordem-id="{{$ordemservico->id}}" data-toggle="modal" data-target="#modal-default">
                                                        <i class="fa-tables fa fa-times" aria-hidden="true"></i>Cancelar
                                                    </a>                                                  
                                                @endif
                                                @if($so->status != 5 && $so->status != 8 && $so->status != 6)
                                                    <a type="button" class="btn-jus btn-modal btn-sm btn-danger" href="" data-id="1" data-servico-id="{{$servico->id}}" data-ordem-id="{{$ordemservico->id}}" data-toggle="modal" data-target="#modal-default">
                                                        <i class="fa-tables fa fa-trash" aria-hidden="true"></i>Cancelar
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
                        
                        {{-- Modal --}}
                        <div class="modal fade" id="modal-default">
                            <form class="form-horizontal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Motivo do cancelamento</h4>
                                        <small>*A justificativa deve possuir no mínimo 30 caracteres</small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <textarea class="form-control" id="ta-jus" cols="10" rows="3" value="" minlength="30" maxlength="200" required></textarea>
                                                <div class="pull-right"><span class="caracteres">200 restantes</span>  <br></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                                        <a type="button" id="a-modal" class="a-modal btn btn-primary">
                                            <i class="fa-tables fa fa-times" aria-hidden="true"></i>Cancelar serviço
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- ./Modal --}}
                        
                    </div>

                    <div class="box-footer">
                        @if($osfechada)
                            <button type="submit" class="btn bg-blue pull-right">Gerar Requerimento</button>	
                            <a href="/ordemservico" class="btn-cancel pull-right">Voltar</a>
                        @endif			
                    </div>

                </form>
            </div>
            {{-- ./box --}}

		</div>
	</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')   
    <script>
        function closeModal(){
            $("#modal").modal('hide');
        }

        $('.btn-jus').click(function(){
            var servico_id = $(this).data('servico-id');
            var ordem_id = $(this).data('ordem-id');
            var id = $(this).data('id');

            $('.a-modal').click(function(){
                justificativa = $('#ta-jus').val();
                var len = parseInt(justificativa.length);
                if(len >= 30){
                    if(id == 0){
                        url = "/servico/"+justificativa+"/"+servico_id+"/"+ordem_id+"/cancelar/agendamento";
                    }else if(id == 1){
                        url = "/servico/"+justificativa+"/"+servico_id+"/"+ordem_id+"/cancelar/servico";
                    }
                    $("#a-modal").attr('href', url);
                    $("#a-modal").trigger('click');
                }             
            })                  
        })
    </script>
    <script>
        $(document).on("keydown", "#ta-jus", function () {
            var caracteresRestantes = 200;
            var caracteresDigitados = parseInt($(this).val().length);
            var caracteresRestantes = caracteresRestantes - caracteresDigitados;

            $(".caracteres").text(caracteresRestantes+" restantes");
        });
    </script>
@stop

