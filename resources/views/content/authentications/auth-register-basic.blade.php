@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Register Basic - Pages')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
<style>
  body {
    background-color: #195128 !important;
  }
</style>
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-auth.js')}}"></script>
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Register Card -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center m-4">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <img src="{{ asset('assets/img/logo.png') }}" alt="" style="width: 50%" />
          </a>
        </div>

        <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET">
          <div class="form-floating form-floating-outline mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Entre com seu nome de usuário" autofocus>
            <label for="username">Nome Completo</label>
          </div>
          <div class="form-floating form-floating-outline mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="Entre com seu email">
            <label for="email">Email</label>
          </div>
          <div class="mb-3 form-password-toggle">
            <div class="input-group input-group-merge">
              <div class="form-floating form-floating-outline">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <label for="password">Senha</label>
              </div>
              <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
            </div>
          </div>

          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
              <label class="form-check-label" for="terms-conditions">
                Concordo com a
                <a href="javascript:void(0);">política e os termos de privacidade</a>
              </label>
            </div>
          </div>
          <button class="btn btn-primary d-grid w-100"  style="background-color: #195128";>
            Inscrever-se
          </button>
        </form>

        <p class="text-center">
          <span>Ja possui uma conta?</span>
          <a href="{{url('auth/login-basic')}}">
            <span>Faça Login</span>
          </a>
        </p>

        <div class="divider my-4">
          <div class="divider-text">ou</div>
        </div>

        <div class="d-flex justify-content-center gap-2">
          <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
            <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
            <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
            <i class="tf-icons mdi mdi-24px mdi-github"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
            <i class="tf-icons mdi mdi-24px mdi-google"></i>
          </a>
        </div>
      </div>
    </div>
    <!-- Register Card -->
  </div>
</div>
</div>
@endsection