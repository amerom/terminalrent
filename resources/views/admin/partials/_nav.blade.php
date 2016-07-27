<h1>
	<small>Control panel</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Blank page</li>
</ol>

@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-dismissable" style="margin-top: 10px!important;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>	<i class="icon fa fa-check"></i> Success!</h4>
        {{ Session::get('flash_message_success') }}
    </div>
@elseif(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-dismissable" style="margin-top: 10px!important;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>	<i class="icon fa fa-check"></i> Error!</h4>
        {{ Session::get('flash_message_error') }}
    </div>
@endif