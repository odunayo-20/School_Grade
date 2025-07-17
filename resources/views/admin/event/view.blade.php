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
                        <div class="inbox-body no-pad" style="overflow:scroll" >
                            <section class="mail-list">
                                <div class="mail-sender">
                                    <div class="mail-heading">
                                        <h4 class="vew-mail-header">
                                            <b style="font-size: 14px;">{{ $event->title }}</b>
                                        </h4>
                                    </div>
                                    <hr>
                                    <div class="my-2 media">
                                        <div class="media-body">
                                            <span class="date pull-right">Time: {{ $event->time }} Date:
                                                {{ $event->date }}</span><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ Storage::url($event->image) }}">
                                        <img class="img-thumbnail img-responsive"
                                            style="width: 100%; height:30rem; object-fit:cove; object-position:100% 25%"
                                            alt="attachment" src="{{ Storage::url($event->image) }}">
                                    </a>
                                </div>

                                <div class="px-3 view-mail p-t-2">
                                    <div style="font-size: 14px;" class="w-" style="width: 100%; "> {!! $event->content !!}</div>
                                    <hr>
                                    <p style="font-size: 14px;" class="text-muted">Location: {{ $event->location }}</p>


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
