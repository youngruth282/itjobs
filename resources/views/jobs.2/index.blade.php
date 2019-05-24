@extends('layouts.master')

@section('title','工作追蹤表')
@section('content')

  <div class="input-group mb-11">
    {!! Form::open(array('route' => 'jobs.getsearch','method'=>'POST')) !!}
    <div class="input-group mb-12">
    <select class="form-control" id="whichmode" name="whichmode" onChange="submit();">
        <option value="P"<?php if ($whichmode=="P" or $whichmode=="") echo " selected"; ?>>我的專案</option>
        <option value="D"<?php if ($whichmode=="D") echo " selected"; ?>>部門</option>
      </select>&nbsp;&nbsp;
      <select class="form-control" id="status" name="status" onChange="submit();">
      <option value="N" <?php if ($status=="N") echo "selected"; ?>>進行中</option>
      <option value="Y" <?php if ($status=="Y") echo "selected"; ?>>已完成</option>
      </select>&nbsp;&nbsp;
      @if ($whichmode == "D")
      <!-- <select class="form-control" id="deptid" name="deptid" onChange="submit();">
      <option value=0 <?php if (!isset($deptid) or $deptid==0) echo "selected"; ?>>全部工作</option>
        @foreach ($depts as $did => $deptname)
        <option value={{ $did }} <?php if ($deptid==$did) echo "selected"; ?>>{{ $deptname }}</option>
        @endforeach
      </select>&nbsp;&nbsp; -->
      @else
        {{ Form::hidden('deptid', $deptid) }}
      @endif
      <!-- <select class="form-control" id="orderSeq" name="orderSeq" onChange="submit();">
      <option value="desc" <?php if ($orderSeq=="" or $orderSeq=="desc") echo "selected"; ?>>最近排在前</option>
      <option value="asc" <?php if ($orderSeq=="asc") echo "selected"; ?>>最早排在前</option>
      </select>&nbsp;&nbsp; -->
      {{ Form::text('searchKey', $searchKey ,['class'=>'form-control', 'placeholder'=>"關鍵字", 'size' => 20]) }}&nbsp;&nbsp;
      
<select class="form-control" id="perPage" name="perPage">
	@for ($e=1;$e<=$num;$e++)
	    <option value="{{$e}}" {{ $e==request('perPage') ? 'selected' : '' }} >第{{$e}}頁</option>
	@endfor
</select>
<button type="submit" class="btn btn-success">查詢</button>

</div>
{{ Form::close() }}
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
                @else
                <th nowrap>功能</th>
        @endif
      </tr>
    </thead>
    
    <tbody>
        @include('jobs.formList')
    </tbody>
  </table>
 
@endsection