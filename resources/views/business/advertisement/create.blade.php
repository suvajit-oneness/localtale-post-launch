@extends('business.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
@include('business.partials.flash')

<div class="row">
    <div class="col-12 col-md-7">
        <div class="card">
        	<div class="card-header">Create an advertisement</div>
        	<div class="card-body">
            <form action="{{ route('business.advertisement.store') }}" method="POST" role="form" enctype="multipart/form-data">
            	<div class="row">
            @csrf
            	<input type="hidden" name="business_id" value="{{Auth::user()->id}}">
	            <div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Title</h6>
	                </label>
	                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                    @error('title') {{ $message ?? '' }} @enderror
	            </div>
	            <div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Description</h6>
	                </label>
	                <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" value="{{ old('description') }}"/>
                    @error('description') {{ $message ?? '' }} @enderror
	            </div>
	            <div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Page</h6>
	                </label>
	                <input class="form-control @error('page') is-invalid @enderror" type="text" name="page" id="page" value="{{ old('page') }}"/>
                    @error('page') {{ $message ?? '' }} @enderror
	            </div>
	            <div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Slot</h6>
	                </label>
	                <input class="form-control @error('slot_id') is-invalid @enderror" type="text" name="slot_id" id="slot_id" value="{{ old('slot_id') }}"/>
                    @error('slot_id') {{ $message ?? '' }} @enderror
	            </div>
	            <div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Image</h6>
	                </label>
	                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                    @error('image') {{ $message }} @enderror
	            </div>
	            <div class="col-sm-12">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Redirect link</h6>
	                </label>
	                <input class="form-control @error('redirect_link') is-invalid @enderror" type="text" name="redirect_link" id="redirect_link" value="{{ old('redirect_link') }}"/>
                    @error('redirect_link') {{ $message ?? '' }} @enderror
	            </div>
                <div class="col-12">Target</div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">Postcode</h6>
	                </label>
	                <input class="form-control @error('target_postcode') is-invalid @enderror" type="text" name="target_postcode" id="target_postcode" value="{{ old('target_postcode') }}"/>
	            </div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">City</h6>
	                </label>
	                <input class="form-control @error('target_city') is-invalid @enderror" type="text" name="target_city" id="target_city" value="{{ old('target_city') }}"/>
	            </div>
	            <div class="col-sm-6">
	                <label class="mb-1">
	                    <h6 class="mb-0 text-sm text-dark">State</h6>
	                </label>
	                <input class="form-control @error('target_state') is-invalid @enderror" type="text" name="target_state" id="target_state" value="{{ old('target_state') }}"/>
	            </div>
	            <div class="col-sm-12">
	                <button type="submit" class="btn btn-blue text-center">Add Advertisement</button>
	            </div>
	        </div>
	        </form>
	    </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
