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
        {{ Form::label('sub_title', 'Sub Title :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('sub_title', null, ['class' => 'form-control', 'placeholder' => 'Sub Title']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('image', 'Select Image :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image))
            {{ Html::image('/uploads/feature-banners/'.$item->image, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>
