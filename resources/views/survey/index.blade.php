@extends('article.plane')

@section('title','Article 首頁')
@section('content')

<section class="container">

        @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
        @endif

<a href="{{ url('article/create') }}" class="btn btn-primary pull-right">Create</a>

    <table class="table table-hover">

    @foreach ($query as $var)
        <tr>
            <td>{{ $var->id }}</td>
            <td>{{ $var->title }}</td>
            <td><img src="uploads/{{ $var->cover_image }}" style="width: 300px;"></td>
            <td>{{ $var->updated_at }}</td>
            <td><a href="{{ url('article/'.$var->id.'/edit') }}" role="btn" class="btn btn-warning">編輯</a></td>
          <form action="{{ route('article.destroy', $var->id) }}" method="POST">
            @csrf
            @method('DELETE')    
            <td><button type="submit" class="btn btn-danger">刪除</a></td>
          </form>    
        </td>
    @endforeach

    </table>
</section>

@endsection