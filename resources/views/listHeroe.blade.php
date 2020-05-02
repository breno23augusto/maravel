@extends('layouts.app')

@section('css')
<link href="{{ asset('css/some.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="card-columns">
        @foreach ($heroes as $heroe)

        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="card " style="width: 18rem;">
                <img class="card-img-top" src="{{$heroe['thumbnail']['path'].'.'.$heroe['thumbnail']['extension']}} " alt="{{$heroe['name']}} image">
                <div class="card-body">
                    <h5 class="card-title">{{$heroe['name']}}</h5>
                    <p class="card-text">{{$heroe['description']}}</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hero-{{$heroe['id']}}">
                        Ver mais
                    </button>
                    <div class="modal fade" id="hero-{{$heroe['id']}}" tabindex="-1" role="dialog" aria-labelledby="hero-{{$heroe['id']}}-Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="hero-{{$heroe['id']}}-Label">{{$heroe['name']}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-dark">
                                    <p>{{$heroe['description']}}</p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Link</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($heroe['urls'] as $index => $info)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td>{{$info['type']}}</td>
                                                <td><a href="{{$info['url']}}">{{$info['url']}}</a>></td>
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
        </div>
        @endforeach
    </div>
</div>

@endsection