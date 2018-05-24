@extends('adminlte::page')

@section('title')

@section('content_header')
@stop

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="title-b-page box-title">Cidades</h3>
            <a href="/cidades/create" class="btn bg-blue pull-right btn-cadastro-cidadao"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Cadastrar nova cidade</a>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
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
                    @if(session()->has('error'))
                        <div class="callout callout-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif                
                <table id="tb-cidades" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="tb-cidades_info">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>UF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cidades as $cidade)
                        <tr>
                            <td>{{$cidade->id}}</td>
                            <td>{{$cidade->nome}}</td>
                            <td>{{$cidade->uf}}</td>
                            <td>         
                                <a type="button" class="btn-editar btn-sm bg-yellow" href="cidades/{{$cidade->id}}/edit" > 
                                    <i class="fa-tables fa fa-pencil" aria-hidden="true"></i>
                                    <span class="text-editar">Editar</span>
                                </a>
                                <a type="button" class="btn-excluir btn-modal btn-sm bg-red" href="" id="btn-modal" data-cidade-id="{{$cidade->id}}" data-toggle="modal" data-target="#modal-default">
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
                                            <p>Deseja realmente excluir a cidade?</p>
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
            $('#tb-cidades').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : true
            })
        })

        $('.btn-excluir').click(function(){
            var id = $(this).data('cidade-id');
            //console.log(id); 
            $(".formdelete").attr('action', ("cidades/"+id));
        })

        resizeButtons();
        window.onload = function() {
            resizeOnload();
        };
    </script>
@stop