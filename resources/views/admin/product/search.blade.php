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

            <div class="page-title-actions">
                <a href="{{route('product.create')}}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Create
                </a>
            </div>
        </div>
    </div>
    <form method="POST" action="{{route('product.import')}}" enctype="multipart/form-data">
        @csrf
        <ul class="body-tabs body-tabs-layout tabs-animated nav align-items-center">
            <li class="nav-item">
                <input type="file" name="products-excel">
                @error('products-excel')
                    <x-alert type="danger" message="{{ $message }}"/>
                @enderror
            </li>
            <li class="nav-item">
                <button type="submit" class="nav-link">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fas fa-file-import fa-w-20"></i>
                    </span>
                    <span>Import</span>
                </button>
            </li>
            <li class="nav-item">
                <a href="{{route('product.export')}}" class="nav-link">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fas fa-file-export fa-w-20"></i>
                    </span>
                    <span>Export</span>
                </a>
            </li>
        </ul>
    </form>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">

                    <form action="{{ route('product.search') }}">
                        <div class="input-group">
                            <input type="search" name="search" id="search" placeholder="Search everything" class="form-control" required>

                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>&nbsp;
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>

                    <a class="ml-5" style="border: 1px solid; padding: 7px; text-decoration: none" href="{{route('product.trash')}}">Trash</a>

                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="btn btn-focus">This week</button>
                            <button class="active btn btn-focus">Anytime</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if ($products->total() == 0)
                        <h5 class="text-center" style="padding: 50px 0">Không tìm thấy sản phẩm nào</h5>
                    @else
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Name</th>
                                    <th class="text-center">Price</th>  
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center text-muted">#{{ $product->id}}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img style="height: 60px;"
                                                            data-toggle="tooltip" title="Image"
                                                            data-placement="bottom"
                                                            src="{{'storage/'.$product->image}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $product->name }}</div>
                                                    <div class="widget-subheading opacity-7"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{number_format($product->price)}} VNĐ</td>
                                    <td class="text-center">
                                        <a href="{{route('product.show',$product)}}"
                                            class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Details
                                        </a>
                                        <a href="{{route('product.edit',$product)}}" data-toggle="tooltip" title="Edit"
                                            data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-edit fa-w-20"></i>
                                            </span>
                                        </a>
                                        <form class="d-inline" action="{{route('product.destroy', $product)}}" method="POST">
                                            @csrf
                                            <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm" type="submit" 
                                                data-toggle="tooltip" title="Delete" data-placement="bottom"
                                                onclick="return confirm('Do you really want to delete this item?')">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <i class="fa fa-trash fa-w-20"></i>
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                                
                            </tbody>
                        </table>
                    @endif
                </div>

                <div class="d-block card-footer">
                    <nav role="navigation" aria-label="Pagination Navigation"
                        class="flex items-center justify-between">
                        <div class="flex justify-between flex-1 sm:hidden">
                            <span
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                « Previous
                            </span>

                            <a href="#page=2"
                                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                Next »
                            </a>
                        </div>

                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700 leading-5">
                                    Showing
                                    <span class="font-medium">{{ $products->firstItem() }}</span>
                                    to
                                    <span class="font-medium">{{ $products->count()}}</span>
                                    of
                                    <span class="font-medium">{{$products->total()}}</span>
                                    results
                                </p>
                            </div>

                            <div>
                                {{ $products->links() }}
                            </div>
                        </div>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Main -->
@endsection