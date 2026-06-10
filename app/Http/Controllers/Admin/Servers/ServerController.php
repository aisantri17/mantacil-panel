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
        $query = Server::query()->with('node', 'user', 'allocation');
        
        // MantaCil Privacy: Only SuperAdmin (ID 1) can see all servers
        if ($request->user()->id !== 1) {
            $query->where('owner_id', $request->user()->id);
        }

        $servers = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::exact('owner_id'),
                AllowedFilter::custom('*', new AdminServerFilter()),
            ])
            ->paginate(config()->get('mantacil.paginate.admin.servers'));

        return view('admin.servers.index', ['servers' => $servers]);
    }
}
