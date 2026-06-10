<?php

namespace MantaCil\Http\Controllers\Admin\Servers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use MantaCil\Models\Server;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use MantaCil\Http\Controllers\Controller;
use MantaCil\Models\Filters\AdminServerFilter;

class ServerController extends Controller
{
    /**
     * Returns all the servers that exist on the system using a paginated result set. If
     * a query is passed along in the request it is also passed to the repository function.
     */
    public function index(Request $request): View
    {
        $servers = QueryBuilder::for(Server::query()->with('node', 'user', 'allocation'))
            ->allowedFilters([
                AllowedFilter::exact('owner_id'),
                AllowedFilter::custom('*', new AdminServerFilter()),
            ])
            ->paginate(config()->get('mantacil.paginate.admin.servers'));

        return view('admin.servers.index', ['servers' => $servers]);
    }
}
