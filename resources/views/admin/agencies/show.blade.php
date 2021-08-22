@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.agency.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agencies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.agency.fields.id') }}
                        </th>
                        <td>
                            {{ $agency->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agency.fields.name') }}
                        </th>
                        <td>
                            {{ $agency->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agency.fields.agency_code') }}
                        </th>
                        <td>
                            {{ $agency->agency_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agency.fields.bank') }}
                        </th>
                        <td>
                            {{ $agency->bank->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agencies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#agency_accounts" role="tab" data-toggle="tab">
                {{ trans('cruds.account.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="agency_accounts">
            @includeIf('admin.agencies.relationships.agencyAccounts', ['accounts' => $agency->agencyAccounts])
        </div>
    </div>
</div>

@endsection