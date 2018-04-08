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
        {{ Form::label('data_key', 'Key :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('data_key', null, ['class' => 'form-control', 'placeholder' => 'Key', 'disabled' => isset($item) && isset($item->data_key) ? true : false, 'required' => 'required']) }}
        </div>
    </div>
</div>


<div class="box-body">
    <div class="form-group">
        {{ Form::label('value', 'Content :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::textarea('value', null, ['rows' => 10, 'cols' => 40, 'class' => 'form-control']) }}
        </div>
    </div>
</div>
