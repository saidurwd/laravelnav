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
                            <form action="{{ url('menus/update') }}" class="form-inline" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="id_edit" value="">
                                <div class="mb-3 mt-3">
                                    <label for="email" class="form-label clearfix">Menu Location</label><br/>
                                    @if(count($locations) > 0)
                                        @foreach($locations as $location)
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input"
                                                       id="location_id_edit"
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
                                                <input type="radio" class="form-check-input" id="type_id_edit"
                                                       name="type_id" value="{{$type->id}}" required>
                                                <label class="form-check-label"
                                                       for="radio{{$type->id}}">{{$type->title}}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="email" class="form-label">Menu Name</label>
                                    <input type="text" class="form-control" id="menu_name_edit" placeholder="Text Here"
                                           name="menu_name" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="email" class="form-label">Menu Link</label>
                                    <input type="text" class="form-control" id="menu_link_edit" placeholder="#"
                                           name="menu_link"
                                           required>
                                </div>
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="new_tab" id="new_tab_edit" value="1">
                                        Open in a new tab
                                    </label>
                                </div>
                                <div class="form-check mb-3 pt-5 float-end">
                                    <label class="form-check-label">
                                        <button type="submit" class="btn btn-warning" style="width: 100px;">Update
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
            <div id="load" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <input type="hidden" id="nestable-output">
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
                        $('#DeleteMenuModal').load(document.URL + '#dd');
                    })
                });
                $(document).on('click', '.EditMenuModal', function () {
                    var id = $(this).val();
                    $('#EditMenuModal').modal('show');
                    $.ajax({
                        type: "GET",
                        url: "menus/update-menu/" + id,
                        success: function (response) {
                            // console.log(response);
                            $('#location_id_edit').val(response.menus.location_id);
                            $('#type_id_edit').val(response.menus.type_id);
                            $('#menu_name_edit').val(response.menus.menu_name);
                            $('#menu_link_edit').val(response.menus.menu_link);
                            $('#new_tab_edit').val(response.menus.new_tab);
                            $('#id_edit').val(response.menus.id);
                        },
                        error: function (xhr, status, error) {
                            alert(error);
                        }
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
