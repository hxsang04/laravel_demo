@extends('admin.layout.master')

@section('content')
<!-- Main -->
<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Product
                    <div class="page-title-subheading">
                        View, create, update, delete and manage.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form method="POST" action="/admin/product/create" enctype="multipart/form-data">
                    @csrf
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="name" id="name" placeholder="Name" type="text" class="form-control" value="{{ old('name')}}">
                                @error('name')
                                    <x-alert type="danger" message="{{ $message }}"/>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="price" class="col-md-3 text-md-right col-form-label">Price</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="price" id="price" placeholder="Price" type="number" class="form-control" value="{{old('price')}}">
                                @error('price')
                                    <x-alert type="danger" message="{{ $message }}"/>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="description" class="col-md-3 text-md-right col-form-label">Description</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea class="form-control" name="description" id="description" placeholder="Description">{{ old('description')}}</textarea>
                                @error('description')
                                    <x-alert type="danger" message="{{ $message }}"/>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="image" class="col-md-3 text-md-right col-form-label">Image</label>
                            <div class="col-md-9 col-xl-8">
                                <input name="image" id="image" type="file" class="form-control p-0" style="border: none;">
                                @error('image')
                                    <x-alert type="danger" message="{{ $message }}"/>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="#" class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Cancel</span>
                                </a>

                                <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>
                                    <span>Save</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main -->
@endsection