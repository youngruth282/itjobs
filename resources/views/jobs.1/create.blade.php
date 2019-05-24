@extends('layouts.master')

@section('title','新增工作追蹤表')
@section('content')

  <p>新增工作追蹤表 </p>

{!! Form::model($job = new \App\Job, ['url' => 'jobs']) !!}
@include('jobs.partial')

      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href={{ route('jobs.index') }} class="btn btn-secondary">回前</a>
            {{ Form::submit('確定送出', array('class' => 'btn btn-primary')) }}
      </div>


{!! Form::close() !!}
@endsection


