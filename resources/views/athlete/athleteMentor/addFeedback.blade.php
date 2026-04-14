@extends('layout.athlete.app')

@section('content')


    <div class="">
        <div class="commmon-crads">

            <div class="row">
                <div class="col-xxl">

                    <div class="card mb-4">

                        {{-- Header --}}

                        <div class="simple-dashboard-heading">
                           <i class="fas fa-comment-dots"></i>
                            <span>Add Feedback</span>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif


                        <div class="card-new-ads bg-all-cards">
                            <form action="{{ route('athlete.feedback-store') }}" method="POST">
                                @csrf
                                <div class="card-body ">

                                    {{-- feedback --}}
                                    <div class="row mb-3">
                                        <label class="col-sm-12 col-form-label">Mentor's Feedback <span
                                                style="color: red">*</span></label>
                                        <div class="col-sm-12">
                                            <textarea name="feedback" class="form-control"
                                                placeholder="Give a feedback....."></textarea>

                                            @error('feedback')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary-adds">Add</button>

                                </div>


                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection