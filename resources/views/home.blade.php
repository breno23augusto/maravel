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
            <a href="{{route('all')}}">
                Clique para ver todos os heróis ou pesquise:
            </a>
        </div>
        <div>
            <form action="{{route('search')}}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="hero-name" class="sr-only">Pesquise o nome do Herói</label>
                    <input type="text" class="form-control" id="hero-name" name="hero-name" required>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Pesquisar</button>
            </form>
        </div>
    </div>
</div>

@endsection
