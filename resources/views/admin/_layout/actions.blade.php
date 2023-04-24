@php
    $delete ??= null;
    $edit ??= null;
@endphp

<div class="dataTable_actions">
    @if($edit)
        <a href="{{ $edit }}" class="btn btn-default btn-sm d-inline-block{{ $edit === '#' ? ' disabled' : '' }}" data-tooltip="tooltip" title="@lang('admin.label.edit')">
            <i class="fa fa-edit"></i>
        </a>
    @endif
    @if($delete)
        <a href="{{ $delete }}" class="btn btn-danger btn-sm d-inline-block{{ $delete === '#' ? ' disabled' : '' }}" data-tooltip="tooltip" title="@lang('admin.label.delete')">
            <i class="fa fa-trash"></i>
        </a>
    @endif
</div>
