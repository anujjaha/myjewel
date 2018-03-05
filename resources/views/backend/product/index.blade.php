@extends ('backend.layouts.app')

@section ('title',  isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@section('after-styles')
    {{-- {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }} --}}

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">

    

@endsection

@section('page-header')
    <h1>{{ isset($repository->moduleTitle) ? $repository->moduleTitle : '' }} Management</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($repository->moduleTitle) ? str_plural($repository->moduleTitle) : '' }} Listing</h3>

            <div class="box-tools pull-right">
                @include('common.product.index-header-buttons', ['createRoute' => $repository->getActionRoute('createRoute')])
            </div>
        </div>

        <div class="box-body">
            <div class="row">


            <div class="col-md-2  pull-right">
                <div id="flip" class="btn btn-success">Bulk Upload</div>
                
            </div>
            <div class="col-md-10">
                <div id="panel" style="display: none;">
                    {{ Form::open([
                        'route'     => $repository->getActionRoute('bulkUploadRoute'),
                        'class'     => 'form-horizontal',
                        'role'      => 'form',
                        'method'    => 'post',
                        'files'     => true
                    ])}}
                    <table class="table">
                        <tr>
                            <td> Upload CSV File : 
                            <p> <a target="_blank" href="{!! URL::to('uploads/bulk-upload/default.csv') !!}">Download Sample file</a></p>
                            </td>
                            <td> <input type="file" name="csv_file" class="form-control">
                            <td> {{ Form::submit('Bulk Upload', ['class' => 'btn btn-success btn-xs']) }} </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-md-2">
                <div id="bulkDeleteBtn" class="btn btn-primary">Bulk Delete</div>
            </div>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="items-table" class="table table-condensed table-hover">
                    <thead>
                        <tr id="tableHeadersContainer"></tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">History</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! history()->renderType('Product') !!}
        </div>
    </div>
@endsection

@section('after-scripts')

    
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
    
    {{-- {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }} --}}

    <script>
        var headers      = JSON.parse('{!! $repository->getTableHeaders() !!}'),
            columns      = JSON.parse('{!! $repository->getTableColumns() !!}');
            moduleConfig = {
                getTableDataUrl:        '{!! route($repository->getActionRoute("dataRoute")) !!}',
                deleteMultiProducts:    '{!! route('admin.product.ajax-delete-products') !!}'
            };

        jQuery(document).ready(function()
        {
            BaseCommon.Utils.setTableHeaders(document.getElementById("tableHeadersContainer"), headers);
            /*BaseCommon.Utils.setTableColumns(document.getElementById("items-table"), moduleConfig.getTableDataUrl, 'GET', columns);*/

            setCustomColumns(document.getElementById("items-table"), moduleConfig.getTableDataUrl, 'GET', columns);

            jQuery("#flip").click(function()
            {
                jQuery("#panel").toggle();
            });

            jQuery("#bulkDeleteBtn").on('click', function()
            {
                bulkDeleteRecords();
            });
        });


        function bulkDeleteRecords()
        {
            var favorite = [];

            jQuery.each($("input[name='product-checkbox']:checked"), function()
            {            
                favorite.push($(this).val());
            });

            if(favorite.length < 1)
            {
                alert('Please Select Product First !');
                return;
            }

            var status  = confirm("Do you want to Delete Selected Products ?");

            if(status == true)
            {
                jQuery.ajax({
                    url: moduleConfig.deleteMultiProducts,
                    method: 'POST',
                    data: {
                        productIds: favorite.join(", ")
                    },
                    success: function(data)
                    {
                        if(data.status == true)
                        {
                            alert("Deleted Products Successfully !");
                            location.reload();
                        }
                    },
                    error: function(data)
                    {
                        alert("Something went Wrong ! Contact to Administrator.");
                    }
                });
            }
        }

        function setCustomColumns(element, fetchurl, method, columns)
        {   
            jQuery(element).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: fetchurl,
                    async: true,
                    type: method
                },
                columns: columns,
                searchDelay: 1200,

               
                select: {
                    style:    'multi',
                    selector: 'td:first-child'
                },

            });
        
        }
    </script>
@endsection