<?php

namespace App\DataTables;

use Carbon\Carbon;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable {
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', function ($item){
                $actions = [
                    'edit' => route('admin.user.edit', ['id' => $item->id]),
                    'delete' => route('admin.user.delete', ['id' => $item->id]),
                ];
                return view('admin._layout.actions', $actions);
            })
            ->editColumn('created_at', function ($item){
                return Carbon::parse($item->created_at)->diffForHumans();
            })
            ->editColumn('updated_at', function ($item){
                return Carbon::parse($item->updated_at)->diffForHumans();
            })
            ->rawColumns([
                'actions',
            ]);
    }

    public function query($model)
    {
        return $model->newQuery();
    }

    public function html(): Builder
    {
        $builder = $this->builder();
        $builder->setTableId('user-table');
        $builder->columns($this->getColumns());
        $builder->orderBy(1, 'desc');

        return $builder;
    }

    protected function getColumns(): array
    {
        return [
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center')
                ->title(__('admin.label.actions')),
            Column::make('name')->title(__('admin.label.name')),
            Column::make('email')->title(__('admin.label.email')),
            Column::make('created_at')->title(__('admin.label.created_at')),
            Column::make('updated_at')->title(__('admin.label.updated_at')),
        ];
    }

    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
