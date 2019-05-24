@extends('errors.master')
@section('title', '')
@section('content')
    
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-lg-offset-2 col-md-4 col-md-offset-1 col-sm-6 col-sm-offset-0 col-xs-8 col-xs-offset-2">
        <div class="text-center">
          <img src="https://int5.bolcc.tw/images/404.jpg" alt="" class="img-responsive" style="opacity: 0.5;">
        </div>
      </div>
      <div class="col-lg-5 col-lg-offset-0 col-md-6 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0">
        <h3 class="marginbottom20 title-bold">抱歉，您所要求的頁面不存在 </h3>
        <!-- <p class="">請檢查URL的拼法和大小寫是否正確。</p> -->
        <!-- <p class="marginbottom20">約翰福音十四章16節(上)：「耶穌說我就是道路、真理、生命」。</p> -->
        <p class="">
          <a href="{{ url('/') }}" class="btn btn-orange">回首頁</a>
        </p>
      </div>
    </div>
  </div>
  @endsection
