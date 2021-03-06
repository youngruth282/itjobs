@extends('layouts.master')

@section('title','工作追蹤表')
@section('content')

  <div class="input-group mb-7">
  @if (Request::is('jobs'))
    <a class="btn btn-md btn-success" href="{{ route('jobs.search') }}">查詢</a>
  @else
    {!! Form::open(array('route' => 'jobs.getsearch','method'=>'POST')) !!}
    <div class="input-group mb-10">
      <select class="form-control" id="status" name="status" onChange="submit();">
      <option value="N" <?php if ($status=="N") echo "selected"; ?>>進行中</option>
      <option value="Y" <?php if ($status=="Y") echo "selected"; ?>>已完成</option>
      </select>&nbsp;&nbsp;
      <select class="form-control" id="deptid" name="deptid" onChange="submit();">
      <option value=0 <?php if (!isset($deptid) or $deptid==0) echo "selected"; ?>>全部人員</option>
        @foreach ($myusers as $staff)
          <option value="{{ $staff->pid }}">{{ $staff->user_name }}</option>
        @endforeach
      </select>&nbsp;&nbsp;
      {{ Form::text('searchKey', $searchKey ,['class'=>'form-control', 'placeholder'=>"關鍵字"]) }}
      
      <button type="submit" class="btn btn-success">送出</button>

      </div>
      {{ Form::close() }}
  @endif
</div>
<?php
  if ($status == "Y") $tablecolor="secondary";
  else $tablecolor="info";
?>

  <table class="table table-bordered table-responsive">
    <thead class="bg-{{ $tablecolor }} text-white">
      <tr>
        <th nowrap style="width: 70px;">編號</th>
        <!-- <th nowrap style="width: 70px;">部門</th> -->
        <th nowrap style="width: 150px;">項目</th>
        <th nowrap style="width: 250px;">內容</th>
        <th nowrap style="width: 100px;">負責同工</th>
        <th nowrap style="width: 100px;">執行進度</th>
        <th nowrap style="width: 130px;">預計完成日期</th>
        <th nowrap>備註</th>
        @if (Request::is('jobs'))
                <th nowrap>功能</th>
        @endif
      </tr>
    </thead>
    
    <tbody>
        @include('jobs.formList')
    </tbody>
  </table>

 
@endsection