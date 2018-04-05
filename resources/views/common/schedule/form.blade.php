<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<div class="box-body">
    <div class="form-group">
        {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
        </div>
    </div>
</div>
    
    <div class="box-body">
        <div class="form-group">
        {{ Form::label('start_date', 'Start Date :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                    {{ Form::text('start_date', (isset($item) && isset($item->start_date)) ? date('m/d/Y', strtotime($item->start_date)) : null, ['class' => 'form-control datepicker', 'placeholder' => 'Start Date', 'required' => 'required']) }}
                </div>
            </div>
        </div>
    </div>
        <div class="box-body">
            <div class="form-group">
            {{ Form::label('end_date', 'End Date :', ['class' => 'col-lg-2 control-label']) }}
            <div class="col-lg-10">
                
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                            {{ Form::text('end_date', (isset($item) && isset($item->end_date)) ? date('m/d/Y', strtotime($item->end_date)) : null, ['class' => 'form-control datepicker', 'placeholder' => 'End Date', 'required' => 'required']) }}
                        </div>
                    </div>
                
            </div>
    </div>
    <div class="box-body">
    <div class="form-group">
        {{ Form::label('address_line_one', 'Address Line One :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('address_line_one', null, ['class' => 'form-control', 'placeholder' => 'Address Line One', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('address_line_two', 'Address Line Two :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('address_line_two', null, ['class' => 'form-control', 'placeholder' => 'Address Line Two', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('city', 'City :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('state', 'State :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'State', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('zip', 'Zip :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('zip', null, ['class' => 'form-control', 'placeholder' => 'Zip', 'required' => 'required']) }}
        </div>
    </div>
</div>
@section('after-scripts')
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <script type="text/javascript">
    
    //Date picker
    jQuery('.datepicker').datepicker(
    {
        format: 'mm/dd/yyyy',
        autoclose: true
    })

</script>
@endsection 