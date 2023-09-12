@extends('layouts.master')
@section('content')
    <style>
        .cf:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }

        * html .cf {
            zoom: 1;
        }

        *:first-child + html .cf {
            zoom: 1;
        }

        .dd {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 20px;
        }

        .dd-list {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .dd-list .dd-list {
            padding-left: 30px;
        }

        .dd-collapsed .dd-list {
            display: none;
        }

        .dd-item,
        .dd-empty,
        .dd-placeholder {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 20px;
            line-height: 20px;
        }

        .dd-item > button {
            display: block;
            position: relative;
            cursor: pointer;
            float: left;
            width: 25px;
            height: 20px;
            margin: 5px 0;
            padding: 0;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 0;
            background: transparent;
            line-height: 1;
            text-align: center;
            font-weight: bold;
        }

        .dd3-handle {
            cursor: pointer;
            white-space: nowrap;
        }

        .dd-placeholder,
        .dd-empty {
            margin: 5px 0;
            padding: 0;
            min-height: 30px;
            background: #f2fbff;
            border: 1px dashed #b6bcbf;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-empty {
            border: 1px dashed #bbb;
            min-height: 100px;
            background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }

        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 9999;
        }

        .dd-dragel > .dd-item .dd-handle {
            margin-top: 0;
        }

        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
            box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
        }
    </style>
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
                {{--                {!! $menus !!}--}}
                <div class="cf nestable-lists">
                    <div class="dd" id="nestable">
                        {!! $ddMenus !!}
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
                            <form action="{{ route('menus.store') }}" class="form-inline" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label for="email" class="form-label clearfix">Menu Location</label><br/>
                                    @if(count($locations) > 0)
                                        @foreach($locations as $location)
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input"
                                                       id="location_{{$location->id}}"
                                                       name="location_id" value="{{$location->id}}" required>
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
                                                       name="type_id" value="{{$type->id}}" required>
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
                                    <input type="text" class="form-control" id="menu_link" placeholder="#"
                                           name="menu_link"
                                           required>
                                </div>
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="new_tab" value="1">
                                        Open
                                        in a new
                                        tab
                                    </label>
                                </div>
                                <div class="form-check mb-3 pt-5 float-end">
                                    <label class="form-check-label">
                                        <button type="submit" class="btn btn-warning" style="width: 100px;">Save
                                        </button>
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
                            <form action="@{{ route('menus.update', $menu->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3 mt-3">
                                    <label for="email" class="form-label clearfix">Menu Location</label><br/>
                                    @if(count($locations) > 0)
                                        @foreach($locations as $location)
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input"
                                                       id="location_{{$location->id}}"
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
                                           name="menu_name" value="{{ @$menu->menu_name }}" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="email" class="form-label">Menu Link</label>
                                    <input type="text" class="form-control" id="menu_link" placeholder="#"
                                           name="menu_link"
                                           value="{{ @$menu->menu_link }}" required>
                                </div>
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="new_tab" value="1">
                                        Open
                                        in a new
                                        tab
                                    </label>
                                </div>
                                <div class="form-check mb-3 pt-5 float-end">
                                    <label class="form-check-label">
                                        <button type="submit" class="btn btn-warning" style="width: 100px;">Save
                                        </button>
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
                                    <button type="submit" class="btn btn-danger" id="deleteYes" value=""
                                            style="width: 100px;">
                                        Yes
                                    </button>
                                    <button type="button" class="btn btn-default" data-bs-dismiss="modal"
                                            style="width: 100px;">
                                        Cancel
                                    </button>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="load"></div>
            <input type="hidden" id="nestable-output">
            {{--            <button id="save">Save</button>--}}
            <script>
                $(document).on('click', '.DeleteMenuModal', function () {
                    var url = "menus/find-menu";
                    var id = $(this).val();
                    $.get(url + '/' + id, function (data) {
                        //success data
                        // console.log(id);
                        $('#deleteYes').val(id);
                        $('#DeleteMenuModal').modal('show');
                    })
                });
                $(document).on('click', '#deleteYes', function () {
                    var url = "menus/delete-menu";
                    var id = $(this).val();
                    $.get(url + '/' + id, function (data) {
                        //success data
                        console.log(id);
                        $('#DeleteMenuModal').modal('hide');
                        $('#DeleteMenuModal').load(document.URL + '#DeleteMenuModal');
                    })
                });
                $(document).on('click', '.EditMenuModal', function () {
                    var url = "menus/edit-menu";
                    var id = $(this).val();
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
            <script>
                $(document).ready(function () {
                    var updateOutput = function (e) {
                        var list = e.length ? e : $(e.target),
                            output = list.data('output');
                        if (window.JSON) {
                            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                        } else {
                            output.val('JSON browser support required for this.');
                        }
                    };

                    // activate Nestable for list 1
                    $('#nestable').nestable({
                        group: 1
                    }).on('change', updateOutput);

                    // output initial serialised data
                    updateOutput($('#nestable').data('output', $('#nestable-output')));

                    $('#nestable-menu').on('click', function (e) {
                        var target = $(e.target),
                            action = target.data('action');
                        if (action === 'expand-all') {
                            $('.dd').nestable('expandAll');
                        }
                        if (action === 'collapse-all') {
                            $('.dd').nestable('collapseAll');
                        }
                    });
                });

                $(document).ready(function () {
                    $("#load").hide();
                    $('.dd').on('change', function () {
                        $("#load").show();

                        var dataString = {
                            data: $("#nestable-output").val(),
                        };
                        $.ajax({
                            type: "POST",
                            url: "menus/edit-order",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: dataString,
                            cache: false,
                            success: function (data) {
                                // console.log(data);
                                $("#load").hide();
                            },
                            error: function (xhr, status, error) {
                                alert(error);
                            },
                        });
                    });
                });
            </script>
@endsection
