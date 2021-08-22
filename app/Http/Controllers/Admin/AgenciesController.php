<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgencyRequest;
use App\Http\Requests\StoreAgencyRequest;
use App\Http\Requests\UpdateAgencyRequest;
use App\Models\Agency;
use App\Models\Bank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgenciesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('agency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = Agency::with(['bank'])->get();

        return view('admin.agencies.index', compact('agencies'));
    }

    public function create()
    {
        abort_if(Gate::denies('agency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = Bank::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.agencies.create', compact('banks'));
    }

    public function store(StoreAgencyRequest $request)
    {
        $agency = Agency::create($request->all());

        return redirect()->route('admin.agencies.index');
    }

    public function edit(Agency $agency)
    {
        abort_if(Gate::denies('agency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banks = Bank::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agency->load('bank');

        return view('admin.agencies.edit', compact('banks', 'agency'));
    }

    public function update(UpdateAgencyRequest $request, Agency $agency)
    {
        $agency->update($request->all());

        return redirect()->route('admin.agencies.index');
    }

    public function show(Agency $agency)
    {
        abort_if(Gate::denies('agency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agency->load('bank', 'agencyAccounts');

        return view('admin.agencies.show', compact('agency'));
    }

    public function destroy(Agency $agency)
    {
        abort_if(Gate::denies('agency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agency->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgencyRequest $request)
    {
        Agency::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
