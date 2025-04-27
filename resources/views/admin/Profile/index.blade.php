@extends('Layouts.auth-layout')

@section('title', 'Profile')

@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="card author-box">
                            <div class="card-body">
                                <div class="author-box-center">
                                    <img alt="image" src="{{ asset('images/user/' . Auth::guard('admin')->user()->image) }}"
                                        class="rounded-circle author-box-picture">
                                    <div class="clearfix"></div>
                                    <div class="author-box-name">
                                        <a href="#">
                                            {{ Auth::guard('admin')->user()->first_name }}
                                            {{ Auth::guard('admin')->user()->last_name }}
                                        </a>
                                    </div>
                                    <div class="author-box-job">Web Developer</div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="col-12 col-md-12 col-lg-8">
                        <div class="card">
                            <div class="padding-20">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    {{-- <li class="nav-item">
                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                      aria-selected="true">About</a>
                  </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings"
                                            role="tab" aria-selected="false">Setting</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    {{-- <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                    <div class="row">
                      <div class="col-md-3 col-6 b-r">
                        <strong>Full Name</strong>
                        <br>
                        <p class="text-muted">Emily Smith</p>
                      </div>
                      <div class="col-md-3 col-6 b-r">
                        <strong>Mobile</strong>
                        <br>
                        <p class="text-muted">(123) 456 7890</p>
                      </div>
                      <div class="col-md-3 col-6 b-r">
                        <strong>Email</strong>
                        <br>
                        <p class="text-muted">johndeo@example.com</p>
                      </div>
                      <div class="col-md-3 col-6">
                        <strong>Location</strong>
                        <br>
                        <p class="text-muted">India</p>
                      </div>
                    </div>
                    <p class="m-t-30">Completed my graduation in Arts from the well known and
                      renowned institution
                      of India – SARDAR PATEL ARTS COLLEGE, BARODA in 2000-01, which was
                      affiliated
                      to M.S. University. I ranker in University exams from the same
                      university
                      from 1996-01.</p>
                    <p>Worked as Professor and Head of the department at Sarda Collage, Rajkot,
                      Gujarat
                      from 2003-2015 </p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                      industry. Lorem
                      Ipsum has been the industry's standard dummy text ever since the 1500s,
                      when
                      an unknown printer took a galley of type and scrambled it to make a
                      type
                      specimen book. It has survived not only five centuries, but also the
                      leap
                      into electronic typesetting, remaining essentially unchanged.</p>
                    <div class="section-title">Education</div>
                    <ul>
                      <li>B.A.,Gujarat University, Ahmedabad,India.</li>
                      <li>M.A.,Gujarat University, Ahmedabad, India.</li>
                      <li>P.H.D., Shaurashtra University, Rajkot</li>
                    </ul>
                    <div class="section-title">Experience</div>
                    <ul>
                      <li>One year experience as Jr. Professor from April-2009 to march-2010
                        at B.
                        J. Arts College, Ahmedabad.</li>
                      <li>Three year experience as Jr. Professor at V.S. Arts &amp; Commerse
                        Collage
                        from April - 2008 to April - 2011.</li>
                      <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry.
                      </li>
                      <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry.
                      </li>
                      <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry.
                      </li>
                      <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry.
                      </li>
                    </ul>
                  </div> --}}
                                    <div class="tab-pane fade show active" id="settings" role="tabpanel"
                                        aria-labelledby="profile-tab2">
                                        <form action="{{ route('admin.profile.edit', Auth::guard('admin')->user()->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-header">
                                                <h4>Edit Profile</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" class="form-control"
                                                            value="{{ Auth::guard('admin')->user()->first_name }}">
                                                        <div class="invalid-feedback">
                                                            Please fill in the first name
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" class="form-control"
                                                            value="{{ Auth::guard('admin')->user()->last_name }}">
                                                        <div class="invalid-feedback">
                                                            Please fill in the last name
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-7 col-12">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ Auth::guard('admin')->user()->email }}">
                                                        <div class="invalid-feedback">
                                                            Please fill in the email
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-5 col-12">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ Auth::guard('admin')->user()->phone }}">
                                                    </div>
                                                    <div class="form-group col-md-12 col-12">
                                                        <label>Image</label>
                                                        <input type="file" name="image" class="form-control"
                                                            value="">
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 col-12">
                                                        <label>Current Password</label>
                                                        <input type="password" name="current_password" class="form-control"
                                                            value="">
                                                        @error('current_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 col-12">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_password" class="form-control"
                                                            value="">
                                                        @error('new_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 col-12">
                                                        <label>Confirm Password</label>
                                                        <input type="password" name="confirm_password" class="form-control"
                                                            value="">
                                                        @error('confirm_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="text-right card-footer">
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
