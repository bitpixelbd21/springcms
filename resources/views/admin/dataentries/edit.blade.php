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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="card" action="{{route('river.data-entries.update', ['slug' => $slug, 'id' => $id])}}" method="POST">
                        @method('PUT')
                        @csrf
                        {{--<div class="card-header">
                            <h3 class="card-title">Horizontal form</h3>
                        </div>--}}
                        @php
                            use \BitPixel\SpringCms\Constants;
                        @endphp
                        <div class="card-body">
                            @foreach($fields as $slug => $options)
                                @if($options['type'] === Constants::FIELD_TYPE_TEXT)
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                        <div class="col">
                                            <input type="text" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                        </div>
                                    </div>
                                @endif

                                @if($options['type'] === Constants::FIELD_TYPE_NUMBER)
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                        <div class="col">
                                            <input type="number" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                        </div>
                                    </div>
                                @endif

                                @if($options['type'] === Constants::FIELD_TYPE_EMAIL)
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                        <div class="col">
                                            <input type="email" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
                                        </div>
                                    </div>
                                @endif


                                @if($options['type'] === Constants::FIELD_TYPE_PHONE)
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                        <div class="col">
                                            <input type="number" name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>
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
                                                @include('river::admin.components.image-picker', ['name' => $slug, 'default' => river_settings('image')])
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
                                        <textarea name="{{$slug}}" class="form-control" {{$options['is_required'] === 1 ? 'required' : ''}}>

                                        </textarea>
                                        </div>
                                    </div>
                                @endif



                                @if($options['type'] === Constants::FIELD_TYPE_CHECKBOX)
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label {{$options['is_required'] === 1 ? 'required' : ''}}">{{$options['label']}}</label>
                                        <div class="col">
                                            <input type="checkbox"  name="{{$slug}}"  {{$options['is_required'] === 1 ? 'required' : ''}}>
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
                                    <textarea class="form-control" id="content_type" name="{{$slug}}"  >

                                    </textarea>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
