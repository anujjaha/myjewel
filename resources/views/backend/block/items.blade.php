@extends ('backend.layouts.app')

@section ('title',  isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>View Order </h1>
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">
                        {{$item->user->name}}
                    </h3>

                    <p class="text-muted text-center">
                        {{$item->user->email}}
                    </p>

                     <p class="text-muted text-center">
                        <strong>Total Cost : {{ $item->total_amount }} </strong>
                    </p>
                </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.box -->
     <div class="col-md-9">
        <div class="box box-success">
            <div class="box-body">
                <p class="text-center text-bold"> Order Details </p>
                <div class="table-responsive">
                    <table id="items-table" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                            <th> Name </th>
                            <th> Qty </th>
                            <th> Price </th>
                            <th> Sub Total </th>
                        </thead>
                        <tbody>
                            @foreach($item->order_items as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->product->title }}</td>
                                    <td>{{ $orderItem->qty }}</td>
                                    <td>{{ $orderItem->price }}</td>
                                    <td>{{ $orderItem->total }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td align="center"> <strong>Total</strong> </td>
                                    <td>{{ $item->total_qty }}</td>
                                    <td>-</td>
                                    <td>{{ $item->total_amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <center> <a href="{{ route('admin.order.index') }}" class="btn btn-primary"> Back </a></center>
            <br>
        </div>

</div>
@endsection

@section('after-scripts')

   
@endsection