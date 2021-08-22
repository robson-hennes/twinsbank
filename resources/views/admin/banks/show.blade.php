@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bank.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.id') }}
                        </th>
                        <td>
                            {{ $bank->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.bank_code') }}
                        </th>
                        <td>
                            {{ $bank->bank_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.name') }}
                        </th>
                        <td>
                            {{ $bank->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.logo') }}
                        </th>
                        <td>
                            @if($bank->logo)
                                <a href="{{ $bank->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $bank->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banks.index') }}">
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
            <a class="nav-link" href="#bank_agencies" role="tab" data-toggle="tab">
                {{ trans('cruds.agency.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bank_agencies">
            @includeIf('admin.banks.relationships.bankAgencies', ['agencies' => $bank->bankAgencies])
        </div>
    </div>
</div>

@endsection