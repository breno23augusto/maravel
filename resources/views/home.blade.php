@extends('layouts.app')
@section('css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Maravel
        </div>

        <div class="links">
            <a href="{{route('some')}}">
                <div style="text-shadow: 0.5px 0 0 #fff, -0.5px 0 0 #fff, 0 2px 0 #fff, 0 -0.5px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
                color: red;">Clique</div> para ver alguns heróis ou pesquise:
            </a>
        </div>
        <div>
            <form action="{{route('search')}}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <input type="text" class="form-control" id="hero-name" name="hero-name" required>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Pesquisar</button>
            </form>
        </div>
    </div>
</div>

@endsection
