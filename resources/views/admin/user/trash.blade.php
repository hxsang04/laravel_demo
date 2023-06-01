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
                    User
                    <div class="page-title-subheading">
                        View, create, update, delete and manage.
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                <a href="./user-create.html" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Create
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">

                    <form>
                        <div class="input-group">
                            <input type="search" name="search" id="search"
                                placeholder="Search everything" class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>&nbsp;
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>

                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="btn btn-focus">This week</button>
                            <button class="active btn btn-focus">Anytime</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Full Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Deleted At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="text-center text-muted">#{{$user->id}}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{$user->name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">
                                    {{$user->deleted_at}}
                                </td>
                                <td class="text-center">
                                     <form class="d-inline" action="{{route('user.restore', $user->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-hover-shine btn-outline-primary border-0 btn-sm" type="submit" 
                                            data-toggle="tooltip" title="Restore" data-placement="bottom"
                                            onclick="return confirm('Do you really want to restore this item?')">
                                            Restore
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
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

                        <div>
                            <p class="text-sm text-gray-700 leading-5">
                                Showing
                                <span class="font-medium">{{$users->firstItem()}}</span>
                                to
                                <span class="font-medium">{{$users->lastItem()}}</span>
                                of
                                <span class="font-medium">{{$users->total()}}</span>
                                results
                            </p>
                        </div>

                        <div>
                            {{$users->links()}}
                        </div>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Main -->

@endsection