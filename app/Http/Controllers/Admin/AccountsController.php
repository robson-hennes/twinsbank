<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccountRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use App\Models\Agency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AccountsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Account::with(['agency'])->select(sprintf('%s.*', (new Account())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'account_show';
                $editGate = 'account_edit';
                $deleteGate = 'account_delete';
                $crudRoutePart = 'accounts';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('agency_name', function ($row) {
                return $row->agency ? $row->agency->name : '';
            });

            $table->editColumn('agency.agency_code', function ($row) {
                return $row->agency ? (is_string($row->agency) ? $row->agency : $row->agency->agency_code) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'agency']);

            return $table->make(true);
        }

        return view('admin.accounts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = Agency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.accounts.create', compact('agencies'));
    }

    public function store(StoreAccountRequest $request)
    {
        $account = Account::create($request->all());

        return redirect()->route('admin.accounts.index');
    }

    public function edit(Account $account)
    {
        abort_if(Gate::denies('account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = Agency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $account->load('agency');

        return view('admin.accounts.edit', compact('agencies', 'account'));
    }

    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->update($request->all());

        return redirect()->route('admin.accounts.index');
    }

    public function show(Account $account)
    {
        abort_if(Gate::denies('account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account->load('agency', 'accountExpenses', 'accountIncomes');

        return view('admin.accounts.show', compact('account'));
    }

    public function destroy(Account $account)
    {
        abort_if(Gate::denies('account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccountRequest $request)
    {
        Account::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
