
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
  </head>
  <body>

   <div class="container"> 
 
    <div class="row">
        <div class="col-12 margin-tb" style="background-color: #FF0000;"> 
            
            <a class="navbar-brand " href="{{ route('conn.clear')}}" style="margin: 10px;">
                <span class="text-white pull-left"><img src="/images/logo-w.png" height="36px"> 台北靈糧堂 同工專屬</span></a> 
                <span class="text-white pull-right">親愛的 同工 {{ $user_name }}，平安！</span>
           
        <!--<div class="pull-right">
            <a class="navbar-brand" href="https://int.bolcc.tw/login/logout" style="margin: 10px;"><span><font color="white"><i class="fa fa-sign-out fa-fw"></i><b>登出</b></font></span></a>  
        </div> -->
        </div> 
    </div>

    <span style="margin-top: 5px;">
        <a href={{ route('jobs.index') }}><span class="btn btn-primary"><span class="badge badge-warning">{{ $num }}</span> 
        @if ($status == "Y")
        已完成工作列表
        @else
        工作進度追蹤表
        @endif
         - 
        @if (Request::is('jobs/search') or Request::is('jobs/search/Y') or Request::is('jobs/getsearch'))
            事工管理處
        @else
            {{ $dept_name }}
        @endif
        </span}></a>
    </span>
    @unless (Request::is('jobs/create') or Request::is('jobs/*/edit'))
        <span style="margin-top: 5px;"><a class="btn btn-md btn-warning" href="{{ route('jobs.create') }}">新增工作</a></span>
        @if ($num > 0)
            @if (Request::is('jobs/search') or Request::is('jobs/getsearch'))
                <span style="margin-top: 5px;">
                    <a class="btn btn-secondary" href="{{ route('posts.export',['deptid'=> $deptid, 'status'=>$status, 'searchKey' => $searchKey ]) }}"> 下載 </a>
                </span>
            @else
                <span style="margin-top: 5px;">
                    <a class="btn btn-secondary" href="{{ route('posts.export',['deptid'=> -1, 'status'=>$status, 'searchKey' => '' ]) }}"> 下載 </a>
                </span>
            @endif
        @endif
    @endunless

    @yield('content')

    @include('jobs.footer')


   </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  </html>