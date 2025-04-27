@extends('Layouts.auth-layout')

@section('title', 'Student')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <span class="text-success"> {{ session('success') }}</span>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <div class="w-100">
                                    <h4 style="float: left; width:50%; display:inline;">Student Result Details</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{-- <table> --}}
                                    <livewire:admin.mark-result-view />
                                    {{-- </table> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
