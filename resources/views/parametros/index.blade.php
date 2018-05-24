@extends('adminlte::page')

@section('title')

@section('content_header')
@stop

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="title-b-page box-title">Parâmetros</h3>
            <a href="/parametros/create" class="btn bg-blue pull-right btn-parametro"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Cadastrar novo parâmetro</a>
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

                <table id="td-parametros" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="td-parametros_info">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($parametros as $parametro)
                        <tr>
                            <td>{{$parametro->id}}</td>
                            <td>{{$parametro->descricao}}</td>
                            <td>{{$parametro->valor}}</td>
                            <td> 
                                <a type="button" href="/parametros/{{ $parametro->id }}/edit" class="btn-editar btn-modal btn-sm bg-yellow">
                                    <i class="fa-tables fa fa-pencil" aria-hidden="true"></i>
                                    <span class="text-editar">Editar</span>
                                </a>
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
            //$('#td-parametros').DataTable()
            $('#td-parametros').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
            })
        })

        $('.btn-modal').click(function(){
            var id = $(this).data('parametro-id');
            var name = $(this).data('parametro-name');
            //console.log(id); 
            $(".formdelete").attr('action', ("parametros/"+id));
            $(".frase-modal").text('Deseja realmente excluir '+name+' do cadastro?')
        })

        resizeButtons();
        window.onload = function() {
            resizeOnload();
        };
    </script>
@stop