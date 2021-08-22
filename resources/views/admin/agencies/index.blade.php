@extends('layouts.admin')
@section('content')
@can('agency_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.agencies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.agency.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.agency.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Agency">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.agency.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.agency.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.agency.fields.agency_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.agency.fields.bank') }}
                        </th>
                        <th>
                            {{ trans('cruds.bank.fields.codigo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agencies as $key => $agency)
                        <tr data-entry-id="{{ $agency->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $agency->id ?? '' }}
                            </td>
                            <td>
                                {{ $agency->name ?? '' }}
                            </td>
                            <td>
                                {{ $agency->agency_code ?? '' }}
                            </td>
                            <td>
                                {{ $agency->bank->name ?? '' }}
                            </td>
                            <td>
                                {{ $agency->bank->codigo ?? '' }}
                            </td>
                            <td>
                                @can('agency_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.agencies.show', $agency->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('agency_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.agencies.edit', $agency->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('agency_delete')
                                    <form action="{{ route('admin.agencies.destroy', $agency->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('agency_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.agencies.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Agency:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection