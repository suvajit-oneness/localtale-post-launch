@extends('site.app')
@section('title')  @endsection
@section('content')

{{-- {{ dd($queryRFQ) }} --}}

<section class="mt-3 text-center">
    @if (count($resp) > 0)
        <div class="container">
            <div class="questionBanner_text">
                <h1>We found something for you!</h1>
                <div class="questionBanner_text_bottom">
                    <p>Data matched for postcode for {{$queryRFQ->postcode}}, time frame {{$queryRFQ->time_frame}}, budget {{$queryRFQ->budget}} & category {{$queryRFQ->category}} !</p>
                </div>
                <div class="row mb-4">
                    @foreach ($resp as $itemKey => $itemVal)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset($itemVal->image)}}" alt="" class="w-100">
                                    <div class="card-title">{{$itemVal->name}}</div>
                                    <div class="card-text"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
    <div class="container">
        <div class="questionBanner_text">
            <h1>We could not find anything!</h1>
            <div class="questionBanner_text_bottom">
                <p>No data matched for postcode for {{$queryRFQ->postcode}}, time frame {{$queryRFQ->time_frame}}, budget {{$queryRFQ->budget}} & category {{$queryRFQ->category}} !</p>
            </div>
            <div class="button-list mb-4 text-center">
                <li style="display: flex;justify-content: center;">
                    <a href="{{route('get-quotes')}}" class="">Try again</a>
                </li>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
