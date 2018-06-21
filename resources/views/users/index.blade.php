@extends('adminlte::page')

@section('title')

@section('content_header')
@stop

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="title-b-page box-title">Usuários</h3>
            <a href="/users/create" class="btn bg-blue pull-right btn-cadastro-user"><i class="fa-tables fa fa-plus" aria-hidden="true"></i>Cadastrar novo usuário</a>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">

                @if(session()->has('success'))
                    <div class="modal fade" id="modal-pass">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Confirmação</h4>
                            </div>
                            <div class="modal-body">
                                <p><b>Nome do usuário: {{ $user->name }}</b></p>
                                <p><b>Email: {{  $user->email }}</b></p>
                                <p><b>Senha: {{  $user->password }}</b></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Fechar</button>       
                            </div>
                            </div>
                        </div>
                    </div>
                @endif
                    
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

                <table id="tb-users" class="table table-bordered table-striped" role="grid" aria-describedby="td-users_info">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Usuário</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$types->find($user->type_id)->name}}</td>
                            <td> 
                                <a type="button" class="btn-show btn-sm bg-blue" href="/users/{{$user->id}}">
                                    <i class="fa-tables fa fa-eye" aria-hidden="true"></i>
                                    <span class="text-show">Infos</span>                                    
                                </a>
                                <a type="button" href="/users/{{ $user->id }}/edit" class="btn-editar btn-sm bg-yellow">
                                    <i class="fa-tables fa fa-pencil" aria-hidden="true"></i>
                                    <span class="text-editar">Editar</span>
                                </a>
                                {{-- Resetar senha --}}
                                <a type="button" href="" id="btn-modal" data-user-id="{{$user->id}}" data-user-name="{{$user->name}}" class="btn-reset btn-sm bg-black" data-toggle="modal" data-target="#modal-reset">
                                    <i class="fa-tables fa fa-lock" aria-hidden="true"></i>
                                    <span class="text-reset">Resetar senha</span>
                                </a>
                                {{-- ./Buttonn --}}
                                <div class="modal fade" id="modal-reset">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Confirmação</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Após resetada no próximo access será pedido para o usuário estabelecer sua nova senha</p>
                                            <p>Deseja realmente prosseguir com o processo de reset?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                                            <form class="formreset" name="formreset" method="post">
                                                @csrf
                                                <input name="_method" type="hidden" value="PUT">
                                           
                                                <button type="submit" class="btn btn-primary">Resetar</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ./Resetar senha --}}
                                {{-- Excluir --}}
                                <a type="button" href="" id="btn-modal" data-user-id="{{$user->id}}" data-user-name="{{$user->name}}" class="btn-excluir btn-sm bg-red" data-toggle="modal" data-target="#modal-delete">
                                    <i class="fa-tables fa fa-trash" aria-hidden="true"></i>
                                    <span class="text-excluir">Excluir</span>
                                </a>
                                <div class="modal fade" id="modal-delete">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Confirmação</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p class="frase-modal">Deseja realmente excluir o cadastro do usuário?</p>
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
                                {{-- ./Excluir --}}                 
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
            $('#tb-users').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
            })
        })

        $('.btn-reset').click(function(){
            var id = $(this).data('user-id');
            $(".formreset").attr('action', ("user/"+id+"/reset"));
        })

        $('.btn-excluir').click(function(){
            var id = $(this).data('user-id');
            var name = $(this).data('user-name');
            $(".formdelete").attr('action', ("users/"+id));
            $(".frase-modal").text('Deseja realmente excluir '+name+' do cadastro?');
        })

        $(document).ready(function() {
            $('#modal-pass').modal('show');
        })

        $( window ).resize(function() {
            if($( window ).width() <= 1320){
                $('.text-show').text('');     
                $('.text-reset').text('');       
                $('.text-editar').text('');   
                $('.text-excluir').text('');
                $('.btn-show').css('float', 'left'); 
                $('.btn-show').css('width', 28);   
                $('.btn-reset').css('float', 'left'); 
                $('.btn-reset').css('width', 28);
                $('.btn-editar').css('float', 'left'); 
                $('.btn-editar').css('width', 28);
                $('.btn-excluir').css('float', 'left'); 
                $('.btn-excluir').css('width', 28);
            }else{
                $('.text-show').text('Infos');      
                $('.text-reset').text('Resetar senha');       
                $('.text-editar').text('Editar'); 
                $('.text-excluir').text('Excluir');
                $('.btn-show').css('float', ''); 
                $('.btn-show').css('width', 'auto');   
                $('.btn-reset').css('float', ''); 
                $('.btn-reset').css('width', 'auto');
                $('.btn-editar').css('float', ''); 
                $('.btn-editar').css('width', 'auto');
                $('.btn-excluir').css('float', ''); 
                $('.btn-excluir').css('width', 'auto');
            }
        });
        
    </script>
@stop