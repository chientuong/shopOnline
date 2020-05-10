@extends('masterpage')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập</h2>
                    <form action="loginCustomer" method="POST">
                        @if (session()->has('message'))
                        {{ session('message') }}
                        {{ session()->put('message', null) }}
                        @endif
                        @csrf
                        <input type="text" name="customerEmail" placeholder="Email" />
                        <input type="password" name="customerPassword" placeholder="Mật khẩu" />
                        {{-- <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span> --}}
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Tạo tài khoản mới</h2>
                    @if (session()->has('message'))
                        {{ session('message') }}
                        {{ session()->put('message', null) }}
                    @endif
                    <form action="signInCustomer" method="POST">
                        @csrf
                        <input type="text" name="customerName" placeholder="Họ & Tên"/>

                        @if ($errors->has('customerName'))
                        <span class="error"> {{ $errors->first('customerName') }}</span>
                        @endif

                        <input type="text" name="customerEmail" placeholder="Email"/>
                        @if ($errors->has('customerEmail'))
                        <span class="error"> {{ $errors->first('customerEmail') }}</span>
                        @endif

                        <input type="password" name="customerPassword" placeholder="Mật khẩu"/>
                        @if ($errors->has('customerPassword'))
                        <span class="error"> {{ $errors->first('customerPassword') }}</span>
                        @endif

                        <input type="text" name="customerAddress" placeholder="Địa chỉ"/>
                        @if ($errors->has('customerAddress'))
                        <span class="error"> {{ $errors->first('customerAddress') }}</span>
                        @endif

                        <input type="text" name="customerNumber" placeholder="Số điện thoại"/>
                        @if ($errors->has('customerNumber'))
                        <span class="error"> {{ $errors->first('customerNumber') }}</span>
                        @endif
                        <button type="submit" class="btn btn-default"  >Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection
