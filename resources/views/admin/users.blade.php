@extends('app')

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Users</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="list_users_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Terminal ID</th>
                        <th>Assigned From</th>
                        <th>Assigned To</th>
                        <th>Active since</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->terminal->terminal_id or '-' }}</td>
                        <td>{{ isset($user->terminal->from) ? Carbon::parse($user->terminal->from)->toFormattedDateString() : '-' }}</td>
                        <td>{{ isset($user->terminal->to) ? Carbon::parse($user->terminal->to)->toFormattedDateString() : '-' }}</td>
                        <td>{{ Carbon::parse($user->created_at)->toFormattedDateString() }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-success btn-flat" type="button">Action</button>
                                <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul role="menu" class="dropdown-menu">
                                    <li class="assign_terminal" data-userid="{{ $user->id }}"><a href="#">Assign terminal</a></li>
                                    <li class="view_report"><a href="reports/{{ $user->id }}">View report</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <div class="modal" id="assign_terminal_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" data-dismiss="modal" data-widget="remove" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Assign Terminal</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('url'=>'terminals','method'=>'POST', 'role' => 'form', 'id' => 'assign_terminal_form')) !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Terminal ID</label>
                                <input type="text" placeholder="Terminal ID" id="terminal_id" name="terminal_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Date range:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="assign_terminal_datetime" name="assignament_interval" class="form-control pull-right">
                                </div><!-- /.input group -->
                            </div>
                            <input type="hidden" value="" name="user_id" id="modal_user_id" />
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button id="submit_assign_terminal" class="btn btn-primary" type="button">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
