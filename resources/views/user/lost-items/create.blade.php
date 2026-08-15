@extends('layouts.app')

@section('title', 'Report Lost Item')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('user.lost-items.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="item_name" class="form-label">Item Name</label>
                            <input type="text" id="item_name" name="item_name" class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}" required>
                            @error('item_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" id="color" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="brand_model" class="form-label">Brand / Model</label>
                            <input type="text" id="brand_model" name="brand_model" class="form-control @error('brand_model') is-invalid @enderror" value="{{ old('brand_model') }}">
                            @error('brand_model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="date_lost" class="form-label">Date Lost</label>
                            <input type="date" id="date_lost" name="date_lost" class="form-control @error('date_lost') is-invalid @enderror" value="{{ old('date_lost') }}" required>
                            @error('date_lost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="time_lost" class="form-label">Time Lost</label>
                            <input type="time" id="time_lost" name="time_lost" class="form-control @error('time_lost') is-invalid @enderror" value="{{ old('time_lost') }}">
                            @error('time_lost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="e.g. Library, 2nd Floor" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="photo" class="form-label">Photo (optional)</label>
                            <input type="file" id="photo" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Submit Report
                    </button>
                    <a href="{{ route('user.lost-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
