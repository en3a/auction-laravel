@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            @if($items->count() > 0)
                                @foreach($items as $item)
                                    <div class="col-4">
                                        <div class="card" style="width: 18rem;">
                                            <img class="card-img-top" src="{{ asset($item->thumbnail) }}"
                                                 alt="{{ $item->name }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->name }}</h5>
                                                <span>Min Bid: {{ $item->minimal_bid }}</span><br>
                                                <span>Bid Number: {{ $item->bids()->count() }}</span><br>
                                                <a href="{{ route('show', ['item' => $item->id]) }}" class="btn btn-primary">Bid Now</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
