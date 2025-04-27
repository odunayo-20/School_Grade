@extends('Layouts.auth-layout')

@section('title', 'Dashboard')


@section('content')
<div class="main-content">
    <section class="section">
      <div class="row ">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card-content">
                      <h5 class="font-15">Total Student</h5>
                      <h2 class="mb-3 font-18">{{ $student }}</h2>
                    </div>
                  </div>
                  <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="banner-img">
                      <img src="assets/img/banner/1.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card-content">
                      <h5 class="font-15"> Subject</h5>
                      <h2 class="mb-3 font-18">{{ $subject }}</h2>
                      {{-- <p class="mb-0"><span class="col-orange">09%</span> Decrease</p> --}}
                    </div>
                  </div>
                  <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="banner-img">
                      <img src="assets/img/banner/2.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card-content">
                      <h5 class="font-15">Class</h5>
                      <h2 class="mb-3 font-18">{{ $class }}</h2>
                    </div>
                  </div>
                  <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="banner-img">
                      <img src="assets/img/banner/3.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-statistic-4">
              <div class="align-items-center justify-content-between">
                <div class="row ">
                  <div class="pt-3 pr-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card-content">
                      <h5 class="font-15">Revenue</h5>
                      <h2 class="mb-3 font-18">$48,697</h2>
                      <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                    </div>
                  </div>
                  <div class="pl-0 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="banner-img">
                      <img src="assets/img/banner/4.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      </div>

    </section>

  </div>
@endsection
