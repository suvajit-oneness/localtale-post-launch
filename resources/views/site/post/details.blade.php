@extends('site.appprofile')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <table class="table table-hover custom-data-table-style table-striped table-col-width" id="sampleTable">
                    <tbody>
                        <tr>
                            <td>Content</td>
                            <td>{{ empty($blog['content'])? null:$blog['content'] }}</td>
                        </tr>
                        <tr>
                            <td>PinCode</td>
                            <td>{{ empty($blog['pincode'])? null:$blog['pincode'] }}</td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('site.localloop.post') }}">Cancel</a>
            </div>


        </div>
    </div>
@endsection
