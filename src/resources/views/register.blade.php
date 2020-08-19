@extends('auth.base')
@section('content')
    <form action="{{route('auth.register')}}" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email"
                   placeholder="請輸入您的email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="請輸入密碼">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1"
                   placeholder="Password">
        </div>
        {{ csrf_field() }}

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{config('custom_auth.home_url')}}" class="btn">Back</a>

    </form>
@endsection
