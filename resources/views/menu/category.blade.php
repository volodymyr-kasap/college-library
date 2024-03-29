@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <i class="icon-calendar"></i>
                            <h3 class="panel-title">{{$parent}} / {{ $name}}</h3>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif                      
                    </div>
                    <div class="container">     
                        <ul class="list-group">
                            @foreach($subjects as $subject)
                                <div>
                                    <li class="list-group-item list-group-item-action">
                                    <a href="{{ route('filterBook',$subject->id) }}">{{$subject->title}}</a></li>
                                </div>                                
                            @endforeach
                        </ul>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
