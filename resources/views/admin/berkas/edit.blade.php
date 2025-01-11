@extends('layouts.admin.template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Berkas Pribadi</h4>

    <form action="{{ route('berkas.update', $berkas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="file_cv" class="form-label">CV</label>
            <input type="file" class="form-control" name="file_cv">
        </div>

        <div class="mb-3">
            <label for="file_kk" class="form-label">KK</label>
            <input type="file" class="form-control" name="file_kk">
        </div>

        <div class="mb-3">
            <label for="file_ktp" class="form-label">KTP</label>
            <input type="file" class="form-control" name="file_ktp">
        </div>

        <div class="mb-3">
            <label for="file_akte" class="form-label">Akte</label>
            <input type="file" class="form-control" name="file_akte">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('berkas.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
