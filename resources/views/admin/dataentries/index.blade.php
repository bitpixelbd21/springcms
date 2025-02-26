@extends('river::admin.layouts.master')

@section('page-header')
<x:river::header>
    <x-slot:title>
        {{ $title }}
        </x-slot>

        <x-slot:breads>
        </x-slot:breads>

        <x-slot:buttons>
            <a href="{{route('river.data-entries.create', $data_slug)}}" class="btn btn-primary d-none d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add new
            </a>
        </x-slot:buttons>

</x:river::header>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            @foreach($headers as $key => $header)
                                <th>{{$header['label']}}</th>
                            @endforeach
                            <th scope="col" style="width: 5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                @foreach($headers as $slug => $meta)
                                    @if($meta['type'] == \BitPixel\SpringCms\Constants::FIELD_TYPE_IMAGE)
                                        <td>
                                            <img src="{{array_key_exists($slug, $row) ? $row[$slug] : ''}}" alt="" width="100">
                                        </td>
                                    @else
                                        <td>
                                            {{array_key_exists($slug, $row) ? $row[$slug] : ''}}
                                        </td>
                                    @endif
                                @endforeach
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('river.data-entries.edit', ['slug' => $data_slug, 'id' => $row['id']]) }}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                        <a href="#" class="confirm-delete btn btn-danger btn-sm" data-href="{{ route('river.data-entries.destroy', ['slug' => $data_slug, 'id' => $row['id']]) }}">
                                            Delete
                                        </a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>

        $('.confirm-delete').click(function (e) {
            var $this = $(this);
            e.preventDefault();
            if (confirm('Are you sure you want to delete this item?')) {
                window.location = $this.data('href');
            }
        });
    </script>
@endpush
