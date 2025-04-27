@extends('Layouts.auth-layout')

@section('title', 'Results')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
<span class="text-success"> {{ session('success')}}</span>
                @endif
              <div class="card">
                <div class="card-header">
                    <div class="w-100">
                        <h4 style="float: left; width:50%; display:inline;">Result Details</h4>
                        <h4 style="float: right; width:50%; display:inline; text-align: right" >
                            <a href="{{route('admin.result.create')}}" class="btn btn-primary">Create</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Action</th>

                        </tr>
                      </thead>
                     <tbody>
                        @foreach ($results as $result)
<tr>
    <td>
      {{ $result->first_name }}
    </td>
    <td>
      {{ $result->last_name }}
    </td>
    <td>
{{$result->email}}
    </td>
    <td>
      {{ $result->status == 1 ? 'hidden' : 'visible' }}
    </td>
    <td>
        <a href="{{route('admin.result.edit', $result->id)}}" class="btn btn-outline-primary">Edit</a>
        <form class="d-inline" action="{{ route('admin.result.delete',$result->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger" type="submit">
                <i class="fa fa-trash"></i>
                {{-- Del --}}
            </button>
        </form>
    </td>
</tr>
                        @endforeach

                     </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
</div>
@endsection
