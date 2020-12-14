@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Item {{ $item->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-4">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ asset($item->thumbnail) }}"
                                         alt="{{ $item->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <span>Min Bid: {{ $item->minimal_bid }}</span><br>
                                        <span>Bid Number: {{ $item->bids()->count() }}</span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <span class="text-muted">Item Description</span> <br>
                                <div class="description">
                                    <h4>
                                        {{ @$item->description }}
                                    </h4>
                                </div>
                                <div class="dates">
                                    Start - {{ date('d/m/Y H:i', strtotime($item->created_at)) }} <br>
                                    Ends - {{ date('d/m/Y H:i', strtotime($item->expires_at)) }}
                                </div>
                                <hr>
                                @if(!isset($lastBidUserId) || $lastBidUserId !== auth()->user()->id)
                                    <div class="form-wrapper">
                                        <form action="{{ route('submitBid', $item->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="bid">
                                                    Enter your bid amount <br>
                                                    <small>Minimal bid amount is {{ $item->minimal_bid }}</small>
                                                    <input type="number" class="form-control" id="bid" name="bid">
                                                </label>
                                                <button class="btn btn-primary">Submit Bid</button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <p class="text-danger">
                                        Cannot bid at the moment,
                                        You already are the last bidder !
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Last Bids At This Item</div>
                    <div class="card-body">
                        <table class="table table-condensed table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Bidder Name</th>
                                <th>Bid Amount</th>
                                <th>Date/Time</th>
                            </thead>
                            <tbody>
                                @foreach($item->bids()->orderBy('created_at', 'desc')->get() as $counter => $bid)
                                    <tr>
                                        <td>{{ ++$counter }}</td>
                                        <td>{{ $bid->user->name }}</td>
                                        <td>{{ $bid->bid_amount }}</td>
                                        <td>{{ $bid->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
