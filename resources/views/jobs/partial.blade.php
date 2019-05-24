<?php
if ($job['app_deptid']){
    $duedate = $job->app_duedate;
    $deptid= $job['app_deptid'];
}else $duedate = date('Y-m-d', strtotime("today +2 week"));
if ($job['app_crewname']){
    $crewname = $job->app_crewname;
}else $crewname = $user_name;

?>

    @if ($job['app_no'])
    <div class="col-xs-12 bg-default">
        <div class="form-group row">        
        <label for="app_no" class="col-sm-2 text-right">編號：</label>
            <div class="col-sm-4">
                {{ $job['app_no'] }}
            </div>
        </div>
    </div>
    @endif
    <!-- <div class="col-xs-12">
        <div class="form-group row">
            <label for="deptid" class="col-sm-2 col-form-label text-right">部門：</label>
            <div class="col-sm-4">
            <select class="form-control" id="app_deptid" name="app_deptid">
            <option value="">--請選擇--</option>
        @foreach ($depts as $did => $deptname)
        <option value="{{ $did }}" <?php if ($deptid==$did) echo "selected"; ?>>{{ $deptname }}</option>
        @endforeach

      </select>
            </div>
        </div>
    </div> -->

    <div class="col-xs-12">
        <div class="form-group row">        
            <label for="crewname" class="col-sm-2 col-form-label text-right"><span style="color:red;">*</span> 負責同工：</label>
            <div class="col-sm-4">
                {!! Form::text('app_crewname', $crewname, ['placeholder' => '請填寫負責同工姓名','class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group row">
            <label for="item" class="col-sm-2 col-form-label text-right">項目：</label>
            <div class="col-sm-10">
                {!! Form::text('app_item', null, ['placeholder' => '請輸入工作項目名稱','class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group row">
            <label for="app_content" class="col-sm-2 col-form-label text-right">內容描述：</label>
            <div class="col-sm-10">
                {!! Form::textarea('app_content', null, [ 'rows' => 3, 'cols' => 40,'placeholder' => '請描述工作內容','class' => 'form-control','style'=>'height:100px']) !!}
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group row">
            <label for="startdate" class="col-sm-2 col-form-label text-right">執行進度：</label>
            <div class="col-sm-10">
                {!! Form::textarea('app_progress', null, [ 'rows' => 2, 'cols' => 40,'placeholder' => '請輸入目前工作執行進度','class' => 'form-control','style'=>'height:100px']) !!}
            </div>
        </div>
    </div>
    
    <div class="col-xs-12">
        <div class="form-group row">        
            <label for="donedate" class="col-sm-2 col-form-label text-right">預計完成日期：</label>
            <div class="col-sm-4">
                {!! Form::date('app_duedate', $duedate, ['class' => 'form-control']) !!}
            </div>
            @if (Request::is('jobs/*/edit'))
            <div class="col-sm-6">
                {!! Form::checkbox('app_status', 'Y', false) !!} 已完成 【勾選已完成後，本項目將不能修改】
            </div>
            @endif
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group row">
            <label for="memo" class="col-sm-2 col-form-label text-right">備註：</label>
            <div class="col-sm-10">
                {!! Form::textarea('app_memo', null, ['rows' => 2, 'cols' => 40,'placeholder' => '備註說明','class' => 'form-control','style'=>'height:100px']) !!}
            </div>
        </div>
    </div>
