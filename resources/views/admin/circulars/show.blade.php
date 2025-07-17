@extends('Layouts.auth-layout')

@section('title', 'Circular Show')

@section('content')
    <div class="main-content">
        <style>
            body {
                font-family: Arial, sans-serif;
                height: 100%;
            }




            .school-details {
                text-align: center;
                font-size: 12px;
                line-height: 1;
            }




            .text {
                font-size: 12px;
            }

            .signatures {
                /* background: red; */
                width: 100%;

            }


            .signature-box {
                width: 50%;
            }

            .signature-line {
                /* border-top: 1px solid black;
                width: 100%; */
            }

.content table, th,td{
    border: 1px;
}


        </style>
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card p-4">
                            <div class="school-details" style="font-size:bold; text-transform: uppercase;">
                                <h2 style="text-align: center;">Ogo-Oluwa Group of Schools, Emure</h2>

                                <p>Behind Energy Filling Station Emure Ile Junction, Owo L.G.A, ONDO STATE </p>
                                <p>ogooluwagse@gmail.com, 09060036867, 08060180552, 08136089968</p>
                                <p>Motto: Education For Better Future</p>
                                <p style="font-size:bold; text-transform: capitalize;">{{ $circular->session->name }} Acedemic Session</p>
                                <p style="font-size:bold; text-transform: capitalize;">{{ $circular->semester->name }} Circular</p>

                            </div>


                            <h1>{{ $circular->title }}</h1>

                            <div class="content">{!! $circular->message !!}</div>

                            <div class="signatures">
                                <div class="signature-box">
                                    <div>_____________________________</div>
                                    <div style="font-size:12px;">Principal’s Signature</div>
                                </div>
                                <div class="signature-box">
                                    <div>_____________________________</div>
                                    <div style="font-size:12px; margin-bottom:5px;">Registrar Signature</div>
                                </div>
                                <div class="signature-bo">
                                    <span style="font-size:12px;">Principal’s Comment</span>
                                    <span>______________________________________________________________
                                        _____________________________________________________________________________</span>
                                </div>

                            </div>

                            {{-- <p class="date-printed" style="font-size: 10px;">Date Printed: {{ $datePrinted }}</p> --}}

                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($circular->circular_date)->format('d M, Y') }}</p>

                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>

@endsection
