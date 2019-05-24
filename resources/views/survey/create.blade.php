@extends('survey.plane')

@section('title','輸入資料')
@section('content')

<div class="row" style="margin-top">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a href={{ url('https://int.bolcc.tw') }} class="btn btn-primary">回同工專屬</a>
                資訊部同工 陳源湘 平安，[您是 B 班別]
            </div>
        </div>

    {!! Form::open(['url' => 'survey', 'files' => true ]) !!}
        <div class="row">
            
                        
          <div aligned="center">
            <table class="table table-hover" style="width:800px;">
                <tr><td colspan="2" class="text-right">請問您的主日崇拜是在：(可複選)</td><td colspan="3">{!! Form::radio('mainswitch','Y',true) !!}本堂 / 福音中心 
                <tr><td colspan="2" class="text-right"></td><td nowrap>{!! Form::radio('mainswitch','X') !!}外教會 / <br />教會名稱：<td>{!! Form::text('nameX', null, array('placeholder' => '教會名稱','class' => 'form-control')) !!}</td>
                <td>{!! Form::text('contentX', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>    
                <tr class="table-primary"><td class="text-right">{!! Form::checkbox('switchA', 'Y') !!}</td><td>山莊第一堂</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceA',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentA', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>    
                <tr class="table-primary"><td class="text-right">{!! Form::checkbox('switchB', 'Y') !!}</td><td>山莊第二堂</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceB',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentB', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>      
                <tr class="table-danger"><td class="text-right">{!! Form::checkbox('switchC', 'Y') !!}</td><td>青年崇拜</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceC',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentC', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>    
                <tr class="table-danger"><td class="text-right">{!! Form::checkbox('switchD', 'Y') !!}</td><td>兒少崇拜</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceD',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentD', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>      
                <tr class="table-success"><td class="text-right">{!! Form::checkbox('switchE', 'Y') !!}</td><td>宣教第一堂</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceE',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentE', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>        
                <tr class="table-success"><td class="text-right">{!! Form::checkbox('switchF', 'Y') !!}</td><td>宣教第二堂</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceF',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentF', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>        
                <tr class="table-success"><td class="text-right">{!! Form::checkbox('switchG', 'Y') !!}</td><td>宣教第三堂</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceG',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentG', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>        
                <tr class="table-secondary"><td class="text-right">{!! Form::checkbox('switchH', 'Y') !!}</td><td>宣教晚崇拜</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceH',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentH', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>        
                <tr class="table-warning"><td class="text-right">{!! Form::checkbox('switchM', 'Y') !!}</td>
                    <td>{!! Form::select('nameM',['福音中心~','1.萬華靈糧福音中心','2.信義靈糧福音中心','3.松山靈糧福音中心','4.中山靈糧福音中心',
                        '5.大同靈糧福音中心','6.中正靈糧福音中心','7.雙園靈糧福音中心','8.南信義靈糧福音中心','9.松江靈糧福音中心',
                        '10.內湖糧福音中心','11.景美靈糧福音中心','12.興隆靈糧福音中心','13.象山靈糧福音中心','14.古亭靈糧福音中心',
                        '15.南機場靈糧福音中心','16.永和靈糧福音中心','17.板城靈糧福音中心','18.竹圍靈糧福音中心','19.三樹靈糧福音中心',
                        '20,南勢角靈糧福音中心','21.大坪林靈糧福音中心','22.淡水靈糧福音中心','23.五股靈糧福音中心','24.八里靈糧福音中心',
                        '25.深坑靈糧福音中心','26.萬金靈糧福音中心','27.廿張靈糧福音中心','28.秀山靈糧福音中心','29.彰化印尼語靈糧福音中心',
                        '30.東石靈糧福音中心','31.澎湖靈糧福音中心','32.頭城靈糧福音中心','33.金門靈糧福音中心','34.太保聚會處靈糧福音中心',
                        ]) !!}</td>
                    <td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceM',['聚會','招待','敬拜團','其他']) !!}</td>
                    <td>{!! Form::text('contentM', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>    
                
                <tr class="table-secondary"><td class="text-right">{!! Form::checkbox('switchZ', 'Y') !!}</td><td>其他聚會{!! Form::text('nameZ', null, array('placeholder' => '崇拜名稱','class' => 'form-control')) !!}</td><td class="text-right">服事項目：</td>
                    <td>{!! Form::select('serviceZ',['聚會','招待','敬拜團','講道','其他']) !!}</td>
                    <td>{!! Form::text('contentZ', null, array('placeholder' => '服事說明','class' => 'form-control')) !!}</td></tr>    
            </table>
          </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>備註：</strong>
                    {!! Form::text('memo', null, array('placeholder' => '可填入其他專長','class' => 'form-control')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">送出</button>
            </div>

        </div>
    {!! Form::close() !!}
    
</div>
@endsection