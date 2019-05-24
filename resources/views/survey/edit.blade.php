@extends('article.plane')

@section('title','輸入資料')
@section('content')

<div class="row" style="margin-top: 10px;">



@if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif

{!! Form::model($item, ['method' => 'PATCH', 'route' => ['article.update', $item->id ]]) !!}
    <div class="row">
    <a href={{ url('article') }} class="btn btn-primary">Home</a>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>title：</strong>
            {!! Form::text('title', null, array('placeholder' => 'please input title','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>content：</strong>
            {!! Form::text('content', null, array('placeholder' => 'please input content','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    </div>
{!! Form::close() !!}
  
</div>
@endsection