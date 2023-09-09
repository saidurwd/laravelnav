@extends('layouts.master')
@section('content')
    <div class="container-fluid p-5 bg-primary text-white text-center">
        <h1>Navigation Settings</h1>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-3 bg-color p-3">
                <h2>Admin Menu</h2>
            </div>
            <div class="col-sm-9 bg-color p-3">
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
                @if(count($menus) > 0)
                    @foreach($menus as $menu)
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <i class="fa-solid fa-grip-vertical"></i> {{$menu->menu_name}}
                                <p class="text-secondary mx-3">{{$menu->menu_link}}</p>
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-eye"></i> <span class="text-uppercase">{{$menu->menu_name}}</span>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                @endif
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
                    <form action="{{url('create')}}" class="form-inline">
                        {{csrf_field()}}
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label clearfix">Menu Location</label><br/>
                            @if(count($locations) > 0)
                                @foreach($locations as $location)
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="location_{{$location->id}}"
                                               name="location_id" value="{{$location->id}}">
                                        <label class="form-check-label"
                                               for="radio{{$location->id}}">{{$location->title}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3 mt-3 clearfix">
                            <label for="email" class="form-label">Menu Type</label><br/>
                            @if(count($types) > 0)
                                @foreach($types as $type)
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="type_{{$type->id}}"
                                               name="type_id" value="{{$type->id}}">
                                        <label class="form-check-label"
                                               for="radio{{$type->id}}">{{$type->title}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Menu Name</label>
                            <input type="text" class="form-control" id="menu_name" placeholder="Text Here"
                                   name="menu_name" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Menu Link</label>
                            <input type="text" class="form-control" id="menu_link" placeholder="#" name="menu_link" required>
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="new_tab" value="1"> Open in a new
                                tab
                            </label>
                        </div>
                        <div class="form-check mb-3 pt-5 float-end">
                            <label class="form-check-label">
                                <button type="submit" class="btn btn-warning" style="width: 100px;">Save</button>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
