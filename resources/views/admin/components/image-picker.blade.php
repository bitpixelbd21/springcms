<div class="input-group">
   <span class="input-group-btn">
     <a id="lfm" data-input="{{$name}}" data-preview="{{$name}}-holder" class="btn btn-primary lfm-picker">
       <i class="fa fa-picture-o"></i> Choose
     </a>
   </span>
   <input id="{{$name}}" class="form-control" type="text" name="{{$name}}" value="{{ $default ?? '' }}">
</div>
<span id="{{$name}}-holder" style="margin-top:15px;max-height:100px;">
    <img class="imageThumb" id="favicon" src="{{ $default ?? '' }}" style="width: 80px; height: 80px">
</span>
