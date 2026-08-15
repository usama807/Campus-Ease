@extends('layouts.app')

@section('title', 'Log Found Item')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Log a Found Item</h4>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.found-items.store') }}" enctype="multipart/form-data">
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
                            <label for="date_found" class="form-label">Date Found</label>
                            <input type="date" id="date_found" name="date_found" class="form-control @error('date_found') is-invalid @enderror" value="{{ old('date_found') }}" required>
                            @error('date_found')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="time_found" class="form-label">Time Found</label>
                            <input type="time" id="time_found" name="time_found" class="form-control @error('time_found') is-invalid @enderror" value="{{ old('time_found') }}">
                            @error('time_found')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="location_found" class="form-label">Location Found</label>
                            <input type="text" id="location_found" name="location_found" class="form-control @error('location_found') is-invalid @enderror" value="{{ old('location_found') }}" placeholder="e.g. Library, 2nd Floor" required>
                            @error('location_found')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="storage_location" class="form-label">Storage Location</label>
                            <input type="text" id="storage_location" name="storage_location" class="form-control @error('storage_location') is-invalid @enderror" value="{{ old('storage_location') }}" placeholder="e.g. Security Office Shelf A" required>
                            @error('storage_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="photos" class="form-label">Photos (optional, multiple allowed)</label>
                            <input type="file" id="photos" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" accept="image/*" multiple>
                            @error('photos.*')
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
                        <i class="bi bi-send"></i> Log Item
                    </button>
                    <a href="{{ route('admin.found-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
