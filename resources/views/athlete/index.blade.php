@extends('layout.athlete.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- PAGE TITLE -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h4 class="fw-bold border-bottom pb-2">
                        Welcome to Athlete Panel Dashboard!
                    </h4>
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
            </div>



        </div>
    </div>
@endsection