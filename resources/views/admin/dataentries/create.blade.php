@extends('river::admin.layouts.master')

@section('page-header')
<x:river::header>
    <x-slot:title>
        {{ $title }}
        </x-slot>

        <x-slot:breads>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.data-entries.index', $data_slug)}}" class="btn d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Back
            </a>
        </x-slot:buttons>

</x:river::header>
@stop

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class=" row ">
                <div class="col-md-8 ">
                    <div class="card mb-2">
                        <div class="card-body ">
                            <form class="" action="{{$action}}" method="POST">
                                @method($method)
                                @csrf

                                <div class="form-group mb-3 ">
                                    <label class="form-label "> Title</label>
                                    <div>
                                        <input type="text" class="form-control generate-slug" name="title" data-slug-field="slug" value="{{ $default_value?$default_value->title : '' }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label "> Slug</label>
                                    <div>
                                        <input type="text" class="form-control" name="slug" value="{{ $default_value? $default_value->slug : ''  }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label "> Content</label>
                                    <div>
                                        <textarea class="form-control" id="content_type" name="content">
                                            {{ $default_value? $default_value->content : ''  }}
                                        </textarea>
                                    </div>
                                </div>
                        </div>
                    </div>



                        <div class="card">
                          <div class="card-header">
                            <h3> SEO</h3>
                          </div>
                          <div class="card-body">
                            <div class="form-group mb-3 ">
                                <label class="form-label "> Meta Title</label>
                                <div>
                                    <input type="text" class="form-control" name="meta_title" value="{{ $default_value? $default_value->meta_title : ''  }}">
                                </div>
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label "> Meta Description</label>
                                <div>
                                    <input type="text" class="form-control" name="meta_description" value="{{ $default_value? $default_value->meta_description : ''  }}">
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="form-label ">Meta  Image <small class="text-warning"></small></label>
                                @include('river::admin.components.image-picker', ['name' => 'meta_image', 'default' => $default_value? $default_value->meta_image : river_settings('image') ])
                            </div>


                          </div>
                        </div>


                </div>



                <div class="col-md-4 ">

                    <div class="row mb-2">

                        <div class="card">
                            <div class="card-header">
                                <label class="form-label ">Publish <small class="text-warning"></small></label>
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input type="checkbox" name="is_published" value="1"  class="form-check-input" id="flexCheckDefault"
                                    @if($default_value)

                                        @if($default_value->is_published==1)
                                         checked
                                        @endif

                                    @endif
                                    />
                                    <label class="form-check-label" for="flexCheckDefault"> Is published</label>
                                  </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary"> Save </button>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-3 row">
                                    <div class=" m-2">
                                        <div class="card-header">
                                            <label class="form-label ">Image <small class="text-warning"></small></label>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">

                                                @include('river::admin.components.image-picker', ['name' => 'featured_image', 'default' => $default_value? $default_value->featured_image : river_settings('image') ])
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 row ">
                                    <div class="m-2">
                                        <label class="form-label "> Sort Order</label>

                                        <div>
                                            <input type="number" class="form-control"  name="order" value="{{ $default_value? $default_value->order : '' }}">
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


                </div>

            </div>

            <div class="row mt-4 ">
                <div class=" ">
                    <div class="card">
                        <div class="col-md-8">
                            {{--<div class="card-header">
                                <h3 class="card-title">Horizontal form</h3>
                            </div>--}}
                            @php
                             use \BitPixel\SpringCms\Constants;
                            @endphp
                            <div class="card-body">
                                @foreach($fields as $slug => $options)
                                    @php
                                        $value = array_key_exists($slug, $data) ? $data[$slug] : ''
                                    @endphp
                                    @if($options['type'] === Constants::FIELD_TYPE_TEXT)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="text" name="{{$slug}}"
                                                       value="{{$value}}"
                                                       class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_NUMBER)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="number" name="{{$slug}}"
                                                       value="{{$value}}"
                                                       class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_EMAIL)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="email" name="{{$slug}}"
                                                       value="{{$value}}"
                                                       class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif


                                    @if($options['type'] === Constants::FIELD_TYPE_PHONE)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="number" name="{{$slug}}"
                                                       value="{{$value}}"
                                                       class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_PASSWORD)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="password" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_IMAGE)
                                        <div class="form-group mb-3 row">
                                            <div class="form-group">
                                                <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                                <div class="col">
                                                    @include('river::admin.components.image-picker', ['name' => $slug, 'default' => $value])
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_DATE)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="date" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_DATETIME)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="datetime-local" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_BELONGSTO)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="text" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_TEXTAREA)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <textarea name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>{{$value}}</textarea>
                                            </div>
                                        </div>
                                    @endif



                                    @if($options['type'] === Constants::FIELD_TYPE_CHECKBOX)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="checkbox"  name="{{$slug}}"
                                                       checked="{{$value === 'yes' ? 'checked' : ''}}"
                                                    {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif


                                    @if($options['type'] === Constants::FIELD_TYPE_RADIO)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">
                                                <input type="radio"  name="{{$slug}}" class="form-check-input" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                            </div>
                                        </div>
                                    @endif


                                    @if($options['type'] === Constants::FIELD_TYPE_DROPDOWN)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">

                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Dropdown link
                                                </a>
                                                <ul name="{{$slug}}"  class="dropdown-menu" aria-labelledby="dropdownMenuLink" {{$options['is_required'] === 1 ? 'required' : ''}} checked>
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif


                                    @if($options['type'] === Constants::FIELD_TYPE_SELECT)
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                            <div class="col">

                                                <select name="{{$slug}}" class="form-select" aria-label="Default select example">
                                                    <option selected>Open this select menu</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    @if($options['type'] === Constants::FIELD_TYPE_RICHTEXT)
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                        <div>
                                            <textarea class="form-control" id="content_type" name="{{$slug}}">{{$value}}</textarea>
                                        </div>
                                    </div>
                                @endif

                                @endforeach
                            </div>
                            {{-- <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}
                        </form>
                    </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


@push('scripts')
<script src="/river/admin/codemirror-5.65.2/lib/codemirror.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/htmlmixed/htmlmixed.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/xml/xml.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/javascript/javascript.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/css/css.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/clike/clike.js"></script>
<script src="/river/admin/codemirror-5.65.2/mode/php/php.js"></script>
<script>
    tinymce.init({
            selector: '#content_type',
        })
        $(function() {
            $('#contentType').change(function(){
                $('.content').hide();
                $('#' + $(this).val()).show();
            });
        });

        $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix});
</script>
@endpush

{{-- @push('scripts')
<script>

    /*tinymce.init({
            selector: '#content_type',
        })*/
        $(function() {
            /*$('#contentType').change(function(){
                $('.{{$slug}}').hide();
                $('#' + $(this).val()).show();
            });*/
            $('.lfm-picker').filemanager('image', {prefix: window.hp_route_prefix})
        });

</script>


@endpush --}}
