@extends('adminlte::page')

@section('title')

@section('content_header')
@stop

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="title-b-page box-title">Operadores</h3>
            <a href="/operadores/create" class="btn bg-blue pull-right btn-cadastro-operadores"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Cadastrar novo operador</a>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    
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
                
                <table id="td-operadores" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="td-operadores_info">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Codigo do operador</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($operadores as $operador)
                        <tr>
                            <td>{{$operador->id}}</td>
                            <td>{{$cidadaos->find($operador->cidadao_id)->nome}}</td>
                            <td>{{$operador->codigo_operador}}</td>
                            <td> 
                                {{-- <a type="button" class="btn-sm bg-blue" href="/operadores/{{$operador->id}}">
                                    <i class="fa-tables fa fa-eye" aria-hidden="true"></i>+ Info
                                </a> --}}
                                <a type="button" href="/operadores/{{ $operador->id }}/edit" class="btn-editar btn-modal btn-sm bg-yellow">
                                    <i class="fa-tables fa fa-pencil" aria-hidden="true"></i>
                                    <span class="text-editar">Editar</span>
                                </a>
                                <a type="button" href="" id="btn-modal" data-operador-id="{{$operador->id}}" data-operador-name="{{$operador->name}}" class="btn-excluir btn-modal btn-sm bg-red" data-toggle="modal" data-target="#modal-default">
                                    <i class="fa-tables fa fa-trash" aria-hidden="true"></i>
                                    <span class="text-excluir">Excluir</span>
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
                                            <p class="frase-modal">Deseja realmente excluir o cadastro da máquina?</p>
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
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function () {
            $('#td-operadores').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
            })
        })

        $('.btn-modal').click(function(){
            var id = $(this).data('operador-id');
            var name = $(this).data('operador-name');
            //console.log(id); 
            $(".formdelete").attr('action', ("operadores/"+id));
            $(".frase-modal").text('Deseja realmente excluir '+name+' do cadastro?')
        })
        
        resizeButtons();
        window.onload = function() {
            resizeOnload();
        };
    </script>
@stop