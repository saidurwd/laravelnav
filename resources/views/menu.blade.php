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
                {!! $menus !!}
                {{--                @if(count($menus) > 0)--}}
                {{--                    @foreach($menus as $menu)--}}
                {{--                        <div class="row mt-3">--}}
                {{--                            <div class="col-sm-4">--}}
                {{--                                <i class="fa-solid fa-grip-vertical"></i> {{$menu->menu_name}}--}}
                {{--                                <p class="text-secondary mx-3">{{$menu->menu_link}}</p>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-sm-6">--}}
                {{--                                <i class="fa fa-eye"></i> <span class="text-uppercase">{{$menu->menu_name}}</span>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-sm-2">--}}
                {{--                                <button type="button" class="btn btn-outline-warning btn-sm"><i--}}
                {{--                                        class="fa fa-pencil"></i>--}}
                {{--                                </button>--}}
                {{--                                <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i>--}}
                {{--                                </button>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    @endforeach--}}
                {{--                @endif--}}
            </div>
        </div>
    </div>
    <!-- The Modal - Create Menu-->
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
                            <input type="text" class="form-control" id="menu_link" placeholder="#" name="menu_link"
                                   required>
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="new_tab" value=""> Open in a new
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
    <!-- The Modal - Edit Menu-->
    <div class="modal" id="EditMenuModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Menu</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{url('update-menu')}}" class="form-inline">
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
                                   name="menu_name" value="" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Menu Link</label>
                            <input type="text" class="form-control" id="menu_link" placeholder="#" name="menu_link"
                                   required>
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="new_tab" value=""> Open in a new
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
    <!-- The Modal - Delete Menu-->
    <div class="modal" id="DeleteMenuModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure about remove the Manu?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <p>Once you remove it can't be undone.</p>
                    <div class="form-check mb-3 pt-5">
                        <label class="form-check-label">
                            <button type="submit" class="btn btn-danger" id="deleteYes" value="" style="width: 100px;">
                                Yes
                            </button>
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal" style="width: 100px;">
                                Cancel
                            </button>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.DeleteMenuModal', function () {
            var url = "find-menu";
            var id = $(this).val();
            $.get(url + '/' + id, function (data) {
                //success data
                // console.log(id);
                $('#deleteYes').val(id);
                $('#DeleteMenuModal').modal('show');
            })
        });
        $(document).on('click', '#deleteYes', function () {
            var url = "delete-menu";
            var id = $(this).val();
            $.get(url + '/' + id, function (data) {
                //success data
                // console.log(id);
                $('#DeleteMenuModal').modal('hide');
                $('#DeleteMenuModal').load(document.URL +  '#DeleteMenuModal');
            })
        });
        $(document).on('click','.EditMenuModal',function(){
            var url = "edit-menu";
            var id= $(this).val();
            $.get(url + '/' + id, function (data) {
                //success data
                console.log(menu_name);
                $('#id').val(id);
                $('#menu_name').val(menu_name);
                $('#menu_link').val(menu_link);
                // $('#btn-save').val("update");
                $('#EditMenuModal').modal('show');
            })
        });

    </script>
@endsection
