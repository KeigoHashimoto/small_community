@extends('layouts.app')

@section('content')
<div class="welcome">
    <h1 class="center">プロフィール登録画面</h1>
    <p class="center">プロフィールが登録できます。</p>
    <div class="schedule-form">
        {{ Form::model($user,['route'=>['user.edit',$user->id],'enctype'=>'multipart/form-data','method'=>'put']) }}
            <div class="make-title">
                {{ Form::label('email','メール') }}
                {{ Form::email('email',null,['class'=>'form-control']) }}
            </div>
            <div class="make-title">
                {{ Form::label('name','名前') }}
                {{ Form::text('name',null,['class'=>'form-control']) }}
            </div>
            <div class="make-title">
                {{ Form::label('profile','プロフィール') }}
                {{ Form::textarea('profile',null,['class'=>'textarea']) }}
            </div>
            <div class="make-title">
                {{ Form::label('profile_img','プロフィール画像') }}
                {{ Form::file('profile_img',null,['class'=>'form-control']) }}
            </div>
            <div class="make-title">
                {{ Form::label('profile_header','プロフィールヘッダー画像') }}
                {{ Form::file('profile_header',null,['class'=>'form-control']) }}
            </div>

            <div class="submit-btn">
                {{ Form::submit('regist',['class'=>'white']) }}
            </div>
        {{ Form::close() }}
    </div>
    
    {!! link_to_route('home','topに戻る',[],['class'=>'center']) !!}
</div>

@endsection