@extends('app')

@section('content')
    <!-- Default box -->
    <div class="box">
        <!-- form start -->
        {!! Form::open(array('url'=>'apply/upload','method'=>'POST', 'files'=>true, 'role' => 'form')) !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    {!! Form::file('file') !!}
                    <p class="text-red">{{$errors->first('file')}}</p>
                    <p class=help-block">Upload your csv file.</p>
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
            </div>
        {!! Form::close() !!}
    </div><!-- /.box -->
@endsection
