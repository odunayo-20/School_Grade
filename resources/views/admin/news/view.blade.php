@extends('layouts.admin-app')

@section('content')
<!-- Main Content start -->
<div class="main-content">
    <!-- section start -->
    <section class="section">
      <div class="section-body">
        <!-- add content start here -->



        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="margin: 0 auto;">
          <div class="card">
            <div class="boxs mail_listing">
              <div class="inbox-body no-pad">
                <section class="mail-list">
                  <div class="mail-sender">
                    <div class="mail-heading">
                      <h4 class="vew-mail-header" >
                        <b style='font-size:14px'>{{ $news->title }}</b><br>
                        <small style='font-size:14px'>{{ $news->subtitle}}</small><br>


                      </h4>
                    </div>
                    <hr>
                    <div class="my-2 media">
                      <div class="media-body">
                        <span class="date pull-right">Time:  {{ $news->time }} Date: {{ $news->date }}</span><br>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                      <a href="{{ Storage::url($news->image) }}">
                          <img class="img-thumbnail img-fluid" style="width:100%; height:30rem; object-fit:cove; object-position:100% 25%" alt="attachment" src="{{ Storage::url($news->image) }}">
                      </a>
                  </div>

                  <div class="view-mail p-t-18">
                      <p style='font-size:14px'>{{ $news->summary }}</p>

                  </div>
                  <div class="view-mail p-t-16">
                    <p>{!! $news->content !!}</p>


                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>


        <!-- add content stop here-->
      </div>

    </section>
    <!-- section stop -->

  </div>
  <!-- Main content stop -->
@endsection
