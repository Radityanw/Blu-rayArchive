<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blu-ray</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit bluray</div>
                    <div class="card-body">
                        <!-- Display validation errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

<form action="{{ route('blurays.update', $bluray->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Method Spoofing for PUT request -->

    <!-- Title -->
    <div class="mb-3">
        <label for="title" class="form-label">Blu-ray Title:</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $bluray->title) }}" required>
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $bluray->description) }}</textarea>
    </div>

    <!-- Image Upload -->
    <div class="mb-3">
        <label for="image" class="form-label">Upload Blu-ray Cover Image:</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
        <small class="text-muted">Leave blank if you don't want to update the cover image.</small>
    </div>

    <!-- Price -->
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $bluray->price) }}" placeholder="Enter price" required>
    </div>

    <!-- Category Selection (Checkbox List) -->
    <div class="mb-3">
        <label class="form-label">Select Categories:</label>
        <div class="form-check">
            @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}"
                        id="category{{ $category->id }}" 
                        {{ in_array($category->id, old('categories', $bluray->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label class="form-check-label" for="category{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Submit Button -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Update Blu-ray</button>
    </div>
</form>
</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
