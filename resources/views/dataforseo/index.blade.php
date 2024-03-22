@extends('dataforseo.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Test task for DataForSeo</h2>
        <div class="card-body">

            @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
            @endsession

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success btn-sm" href="{{ route('create') }}">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Create request
                </a>
            </div>

        </div>
    </div>
@endsection
