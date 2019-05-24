@extends('layouts.master')
@include('jobs.delModal')

@section('title','修改工作追蹤表')
@section('content')

  <h3>修改工作追蹤表 </h3>

    {!! Form::model($job, ['method' => 'PATCH','route' => ['jobs.update', $job->id]]) !!}
    @include('jobs.partial')

      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">刪除</button>
        <a href={{ route('jobs.index') }} class="btn btn-secondary">回前</a>
        {{ Form::submit('確定送出', array('class' => 'btn btn-primary')) }}
        
      </div>


    {!! Form::close() !!}

@endsection

