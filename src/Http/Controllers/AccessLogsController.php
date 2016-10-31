<?php

namespace Historiae\Http\Controllers;

use Historiae\AccessLog;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;

class AccessLogsController extends Controller
{
    /**
     * The response factory implementation.
     *
     * @var ResponseFactory
     */
    protected $response;

    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    public function index()
    {
		$accesses = AccessLog::with('user')->orderBy('created_at', 'desc');

		if (request()->has('filters')) {
			$filters = collect(request('filters'))->reject(function($v) { return !strlen($v); });

			if ($filters->has('url')) {
				$accesses = $accesses->where('url', 'LIKE', "%{$filters->get('url')}%");
			}

			if ($filters->has('method')) {
				$accesses = $accesses->where('method', $filters->get('method'));
			}

			if ($filters->has('status')) {
				$accesses = $accesses->where('status', $filters->get('status'));
			}

			if ($filters->has('ip')) {
				$accesses = $accesses->where('ip', $filters->get('ip'));
			}

			if ($filters->has('start_at')) {
				$accesses = $accesses->whereDate('created_at', '>=', date($filters->get('start_at')));
			}

			if ($filters->has('end_at')) {
				$accesses = $accesses->whereDate('created_at', '<=', date($filters->get('end_at')));
			}
		}

        return $this->response->view('historiae::accesses.index', [
			'methods' => AccessLog::distinct('method')->pluck('method'),
			'statuses' => AccessLog::orderBy('status')->distinct('status')->pluck('status'),
            'accesses' => $accesses->paginate(15)
        ]);
    }
}
