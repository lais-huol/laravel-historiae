@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="" method="GET" class="form-inline">
                    <div class="form-group">
                        <label for="model">{{ trans('historiae::access.method')  }}</label>
                        <select class="form-control" name="filters[method]">
                            <option value="">{{ trans('historiae::general.all') }}</option>
                            @foreach($methods as $method)
                                <option value="{{ $method }}" @if(request('filters.method') == $method) selected @endif>{{ $method }}</option>
                            @endforeach
                        </select>
                    </div>
	                <div class="form-group">
	                    <label for="model">{{ trans('historiae::access.status')  }}</label>
	                    <select class="form-control" name="filters[status]">
	                        <option value="">{{ trans('historiae::general.all') }}</option>
	                        @foreach($statuses as $status)
	                            <option value="{{ $status }}" @if(request('filters.status') == $status) selected @endif>{{ $status }}</option>
	                        @endforeach
	                    </select>
	                </div>
                    <div class="form-group">
                        <label for="created">{{ trans('historiae::access.ip')  }}</label>
                        <input type="text" class="form-control" name="filters[ip]" value="{{ request('filters.ip') }}">
                    </div>
                    <div class="form-group">
                        <label for="created">{{ trans('historiae::access.url')  }}</label>
                        <input type="text" class="form-control" name="filters[url]" value="{{ request('filters.url') }}">
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
            @if($accesses->count())
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>{{ trans('historiae::access.url') }}</th>
                        <th>{{ trans('historiae::access.method') }}</th>
                        <th>{{ trans('historiae::access.status') }}</th>
                        <th>{{ trans('historiae::access.ip') }}</th>
                        <th>{{ trans('historiae::access.user.name') }}</th>
                        <th>{{ trans('historiae::access.created_at') }}</th>
                    </tr>
                </thead>
                @foreach($accesses as $access)
                    <tr>
                        <td>{{ str_limit($access->url, $limit = 80, $end = '...') }}</td>
                        <td>{{ $access->method }}</td>
                        <td>{{ $access->status }}</td>
                        <td>{{ $access->ip }}</td>
                        <td>@if($access->user){{ $access->user->name }}@endif</td>
                        <td>{{ $access->created_at }}</td>
                    </tr>
                @endforeach
            </table>

			<div class="panel-footer">
				{{ $accesses->links() }}

				<div class="pull-right" style="margin: 22px 0;">{{ trans('historiae::general.pagination', ['count' => $accesses->count(), 'total' => $accesses->total()]) }}</span>
			</div>
		@else
		<div class="panel-body text-center">
			{{ trans('historiae::general.empty') }}
		</div>
		@endif
        </div>
    </div>
@stop
