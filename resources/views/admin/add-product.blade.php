@extends('admin.layouts.corona')

@section('title', __('message.add_product'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('message.add_product') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-store-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('message.product_name') }}</label>
                                <input type="text" class="form-control bg-dark text-white @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">{{ __('message.price') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-white">$</span>
                                    <input type="number" step="0.01" class="form-control bg-dark text-white @error('price') is-invalid @enderror" 
                                        id="price" name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">{{ __('message.quantity') }}</label>
                                <input type="number" class="form-control bg-dark text-white @error('quantity') is-invalid @enderror" 
                                    id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">{{ __('message.category') }}</label>
                                <select class="form-select bg-dark text-white @error('category_id') is-invalid @enderror" 
                                    id="category" name="category_id" required>
                                    <option value="">{{ __('message.select_category') }}</option>
                                    @foreach($categories ?? [] as $category)
                                        <option value="{{ optional($category)->id }}" {{ old('category_id') == optional($category)->id ? 'selected' : '' }}>
                                            {{ optional($category)->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('message.description') }}</label>
                        <textarea class="form-control bg-dark text-white @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">{{ __('message.product_image') }}</label>
                        <input type="file" class="form-control bg-dark text-white @error('image') is-invalid @enderror" 
                            id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin-all-products') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> {{ __('message.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> {{ __('message.save_product') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection