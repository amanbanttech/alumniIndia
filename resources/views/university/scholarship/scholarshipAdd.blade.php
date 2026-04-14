@extends('layout.university.app')

@section('content')
<div class="content-wrapper">
              <div class="commmon-crads">
                <div id="formMessage" class="alert d-none"></div>

                @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">

                    <div class="simple-dashboard-heading">
                       <i class="fa fa-user-graduate"></i>
                        <span>Add Scholarship</span>
                    </div> 

                    {{-- Body --}}
                    <div class="card-body">


                        

                        <form action="{{ route('university.scholarship.store') }}" method="POST" novalidate>
                            @csrf

                            {{-- Title --}}
                            <div class="row mb-3">
                              <div class="col-md-12">
                                  <label class="col-sm-12 col-form-label">
                                    Title <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title') }}" placeholder="Enter title">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                            </div>

                            {{-- Description --}}
                            <div class="row mb-3">
                              <div class="col-md-12">
                                  <label class="col-sm-12 col-form-label">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-12">
                                    <textarea name="description"  class="form-control" rows="4"
                                            placeholder="Description....">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                            </div>

                            {{-- open form --}}
                            <div class="row mb-3">
                              <div class="col-md-12">
                                  <label class="col-sm-12 col-form-label">
                                    Open From <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="date" id="open_from" name="open_from" class="form-control" placeholder=""
                                        value="{{ old('open_from') }}" min="{{ date('Y-m-d') }}">
                                    @error('open_from')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                            </div>

                            {{-- End form --}}
                            <div class="row mb-3">
                              <div class="col-md-12">
                                  <label class="col-sm-12 col-form-label">
                                    End <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-12">
                                    <input type="date" name="end" id="end" class="form-control" placeholder=""
                                        value="{{ old('end') }}" >
                                    @error('end')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                            </div>

                            <!-- Submit -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-add-univerity">
                                            Add Scholarship
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('open_from').addEventListener('change', function () {
        let openDate = this.value;
        let endInput = document.getElementById('end');

        endInput.min = openDate;
        endInput.value = ''; // reset end date
    });

    window.addEventListener('load', function () {
    let openDate = document.getElementById('open_from').value;
    if (openDate) {
        document.getElementById('end').min = openDate;
    }
});
</script>



@endsection
