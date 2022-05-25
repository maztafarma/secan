@extends('cms.layout.main')

@section('content')
<div id="videoManager" class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Video</h3>
        </div>
    </div>

    <div class="clearfix"></div>
    @include('cms.pages.video.form')
    @include('cms.partials.confirm-delete')
    <div class="row list_table" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <!-- <div class="x_title">
                    <h2></h2>
                    
                    <div class="clearfix"></div>
                </div> -->
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap no-footer">
                                    <div class="row m-b-30">
                                        <div class="col-sm-10"><h2>List Data</h2></div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-secondary f-right text-08rem" @click="showForm">Add video</button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                    <tr>
                                                        <th class="width-5">#</th>
                                                        <th class="width-15">Thumbnail Image</th> 
                                                        <th>Title</th>
                                                        <th>Category</th>
                                                        <th>Publish Date</th>
                                                        <th class="t-center width-25">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(obj, index) in listData">
                                                        <td scope="row">@{{ index+1 }}</td>
                                                        <td><img :src="obj.home_thumbnail_url" height="50"></td>
                                                        <td>@{{ obj.title }}</td>
                                                        <td>@{{ obj.category }}</td>
                                                        <td>@{{ obj.publish_date }}</td>
                                                        <td colspan="2" style="text-align:center">
                                                            <a class="btn btn-app" href="javascript:void(0)" @click="editData(obj.id)">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            <a class="btn btn-app" href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-sm" @click="showConfirmDelete(obj.id)">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
