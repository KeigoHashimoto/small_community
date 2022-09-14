@extends('layouts.app')

@section('content')
<div class="main">
    <div class="come-in-form form">
        <h1 class="center">会員登録</h1>
    
        {{ Form::open(['route'=>'regist.post']) }}
            <div class="form-group">
                {{ Form::label('name','name',['class'=>'label']) }}
                {{ Form::text('name',null,['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('email','email',['class'=>'label']) }}
                {{ Form::email('email',null,['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('password','password',['class'=>'label']) }}
                {{ Form::password('password',['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation','confirm',['class'=>'label']) }}
                {{ Form::password('password_confirmation',['class'=>'form-control']) }}
            </div>

            {{ Form::submit('submit',['class'=>'submit']) }}
        {{ Form::close() }}

        {{ link_to_route('login','ログイン',[],['class'=>'center']) }}
    </div>
</div>
@endsection