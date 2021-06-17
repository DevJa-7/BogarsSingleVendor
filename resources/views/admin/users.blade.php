@extends('layouts.app_admin')

@section('content')
<div class="card card-cascade narrower">
    <div class="table-responsive"> 
        <table class="table">
            <thead class="blue-grey lighten-4">
                <tr>
                    <th>#</th>
                    <th>{{__('admin_pages.user_name')}}</th>
                    <th>{{__('admin_pages.user_email')}}</th>
                    <th>{{__('admin_pages.user_type')}}</th>
                    <th>{{__('admin_pages.user_created_at')}}</th>
                    <th>{{__('admin_pages.user_updated_at')}}</th>
                    <th class="text-right">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddEditUsers">
                            {{__('admin_pages.add_user')}}
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user) 
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->type}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td class="text-right">
                        @php
                        if ($user->type == 'admin') {
                        @endphp
                        <a href="?edit={{$user->id}}" class="btn btn-sm btn-success">{{__('admin_pages.edit_user')}}</a>
                        <button type="button" class="btn btn-sm btn-danger confirm" onclick="deleteSelectedUser({{$user->id}})">
                            {{__('admin_pages.delete_user')}}
                        </button>
                        @php
                        }
                        @endphp
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>  
</div>
{{ $users->links() }}
<!-- Modal Add/Edit users -->
<div class="modal fade" id="modalAddEditUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary white-text">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{__('admin_pages.user_settings')}}</h4>
            </div>
            <form method="POST" action="" id="formManageUsers">
                <div class="modal-body">
                    {{ csrf_field() }} 
                    <input type="hidden" name="edit" value="{{isset($_GET['edit']) ? $_GET['edit'] : 0 }}"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="defaultForm-name"><i class="fa fa-user prefix grey-text pr-2"></i>{{__('admin_pages.user_name')}}</label>
                                <input type="text" name="name" value="{{$userInfo != null? $userInfo->name : ''}}" id="defaultForm-name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="defaultForm-email"><i class="fa fa-envelope prefix grey-text pr-2"></i>{{__('admin_pages.user_name')}}</label>
                                <input type="text" name="email" value="{{$userInfo != null? $userInfo->email : ''}}" id="defaultForm-email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="defaultForm-pass"><i class="fa fa-lock prefix grey-text pr-2"></i>{{__('admin_pages.user_name')}}</label>
                                <input type="password" name="password" id="defaultForm-pass" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin_pages.close')}}</button>
                <button type="button" class="btn btn-primary" onclick="updateUser()">{{__('admin_pages.save_changes')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete User -->
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary white-text">
                <h4 class="title" id="exampleModalLabel">{{__('admin_pages.confirm_delete_product')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{__('admin_pages.are_u_sure_delete')}}
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-secondary" data-dismiss="modal">{{__('admin_pages.cancel')}}</a>
                <a href="javascript:void(0);" id="deleteUserId" class="btn btn-primary">{{__('admin_pages.delete')}}</a>
            </div>
        </div>
    </div>
</div>

<script>
    @php
            if (isset($_GET['edit']))
    {
    @endphp
            $(document).ready(function(){
    $('#modalAddEditUsers').modal('show');
    });
            $("#modalAddEditUsers").on("hidden.bs.modal", function () {
    window.location.href = "{{ lang_url('admin/users') }}";
    });
            @php
    }
    @endphp
</script>
@endsection
