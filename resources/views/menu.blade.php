@extends('layouts.master')
@section('content')
    <div class="container-fluid p-5 bg-primary text-white text-center">
        <h1>Navigation Settings</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-3">
                <h2>Admin Menu</h2>
            </div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-10">
                        <h4>Drag & Drop to Adjust the Navigation</h4>
                        <p class="text-secondary">This list order will appear in the Design</p>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#createMenuModal">
                            Create Menu
                        </button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <i class="fa-solid fa-grip-vertical"></i> Home
                        <p class="text-secondary mx-3">/home</p>
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-eye"></i> Home Page
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa-solid fa-grip-vertical"></i> Home
                        <p class="text-secondary mx-3">/home</p>
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-eye"></i> Home Page
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa-solid fa-grip-vertical"></i> Home
                        <p class="text-secondary mx-3">/home</p>
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-eye"></i> Home Page
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa-solid fa-grip-vertical"></i> Home
                        <p class="text-secondary mx-3">/home</p>
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-eye"></i> Home Page
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa-solid fa-grip-vertical"></i> Home
                        <p class="text-secondary mx-3">/home</p>
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-eye"></i> Home Page
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa-solid fa-grip-vertical"></i> Home
                        <p class="text-secondary mx-3">/home</p>
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-eye"></i> Home Page
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="createMenuModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create Menu</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="#">
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label clearfix">Menu Location</label><br />
                            @if(count($locations) > 0)
                                @foreach($locations as $location)
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="" name="" value="">
                                        <label class="form-check-label" for="radio1">{{$location->title}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3 mt-3 clearfix">
                            <label for="email" class="form-label">Menu Type</label><br />
                            @if(count($types) > 0)
                                @foreach($types as $type)
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="" name="" value="">
                                        <label class="form-check-label" for="radio1">{{$type->title}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Menu Name</label>
                            <input type="email" class="form-control" id="" placeholder="Text Here" name="">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Menu Link</label>
                            <input type="email" class="form-control" id="emal" placeholder="#" name="">
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Open in a new tab
                            </label>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning">Save</button>
                </div>

            </div>
        </div>
    </div>
