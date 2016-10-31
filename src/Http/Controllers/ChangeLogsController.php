<?php

namespace Historiae\Http\Controllers;

use Historiae\ChangeLog;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;

class ChangeLogsController extends Controller
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
        $changes = ChangeLog::with('user')->orderBy('created_at', 'desc');

        if (request()->has('filters')) {
            $filters = collect(request('filters'))->reject(function($v) { return !strlen($v); });

            if ($filters->has('model')) {
                $changes = $changes->where('model', $filters->get('model'));
            }

            if ($filters->has('created')) {
                $changes = $changes->where('created', $filters->get('created'));
            }

            if ($filters->has('start_at')) {
                $changes = $changes->whereDate('created_at', '>=', date($filters->get('start_at')));
            }

            if ($filters->has('end_at')) {
                $changes = $changes->whereDate('created_at', '<=', date($filters->get('end_at')));
            }
        }

        return $this->response->view('historiae::changes.index', [
            'changes' => $changes->paginate(15),
            'models' => ChangeLog::distinct('model')->get(['model'])->flatMap(function($change) {
                    return [$change->getOriginal('model') => $change->model];
            })
        ]);
    }
}
