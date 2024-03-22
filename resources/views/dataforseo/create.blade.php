@extends('dataforseo.layout')

@section('content')

    <div class="card mt-5">
        <h2 class="card-header">Enter domain(s)</h2>
        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            </div>

            <form action="{{ route('store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="inputTargetDomains" class="form-label">
                        <strong>
                            Target domain:
                            <sup>
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="red" class="bi bi-asterisk" viewBox="0 0 16 16">
                                    <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"></path>
                                </svg>
                            </sup>
                        </strong>
                    </label>
                    <input
                        type="text"
                        name="target_domain"
                        class="form-control @error('target_domain') is-invalid @enderror"
                        id="inputTargetDomains"
                        placeholder="moz.com, ahrefs.com"
                        required>
                    @error('target_domain')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputExcludedDomains" class="form-label"><strong>Excluded target:</strong></label>
                    <input
                        type="text"
                        name="excluded_target"
                        class="form-control @error('excluded_target') is-invalid @enderror"
                        id="inputExcludedDomains"
                        placeholder="bbc.com">
                    @error('excluded_target')
                    <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    &nbsp;
                </div>
                <button type="submit"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    <i class="fa-solid fa-floppy-disk"></i>&nbsp;&nbsp; Send request
                </button>
            </form>

        </div>
    </div>
@endsection
