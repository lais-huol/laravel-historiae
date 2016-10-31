@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="model">{{ trans('historiae::change.model')  }}</label>
                        <select class="form-control" name="filters[model]">
                            <option value="">{{ trans('historiae::general.all') }}</option>
                            @foreach($models as $key => $model)
                                <option value="{{ $key }}" @if(request('filters.model') == $key) selected @endif>{{ $model }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="created">{{ trans('historiae::change.created')  }}</label>
                        <select class="form-control" name="filters[created]">
                            <option value="">{{ trans('historiae::general.all') }}</option>
                            <option value="1" @if(request('filters.created') === '1') selected @endif>{{ trans('historiae::general.boolean.yes') }}</option>
                            <option value="0" @if(request('filters.created') === '0') selected @endif>{{ trans('historiae::general.boolean.no') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="created">{{ trans('historiae::general.range.start')  }}</label>
                        <input type="text" class="form-control" name="filters[start_at]" value="{{ request('filters.start_at') }}">
                    </div>
                    <div class="form-group">
                        <label for="created">{{ trans('historiae::general.range.end')  }}</label>
                        <input type="text" class="form-control" name="filters[end_at]"  value="{{ request('filters.end_at') }}">
                    </div>
                    <button type="submit" class="btn btn-default">Filtrar</button>
                </form>
            </div>
            @if($changes->count())
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>{{ trans('historiae::change.model') }}</th>
                        <th>{{ trans('historiae::change.pk') }}</th>
                        <th>{{ trans('historiae::change.created') }}</th>
                        <th>{{ trans('historiae::general.user') }}</th>
                        <th>{{ trans('historiae::general.time') }}</th>
                    </tr>
                    </thead>
                    @foreach($changes as $change)
                        <tr>
                            <td>{{ $change->model }}</td>
                            <td>{{ $change->created ? "-" : $change->json['id'] }}</td>
                            <td>@if($change->created) @lang('historiae::general.boolean.yes') @else @lang('historiae::general.boolean.no') @endif</td>
                            <td>@if($change->user){{ $change->user->name }}@endif</td>
                            <td>{{ $change->created_at }}</td>
                        </tr>
                    @endforeach
                </table>

                <div class="panel-footer">
                    {{ $changes->links() }}

					<div class="text-right">{{ trans('historiae::general.pagination', ['count' => $changes->count(), 'total' => $changes->total()]) }}</span>
                </div>
            @else
            <div class="panel-body text-center">
                {{ trans('historiae::general.empty') }}
            </div>
            @endif
        </div>
    </div>
@stop
