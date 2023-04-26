<?php

namespace App\DataTables;

use Carbon\Carbon;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable {
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('actions', function ($item){
                $actions = [
                    'edit' => route('admin.product.edit', ['id' => $item->id_product]),
                    'delete' => route('admin.product.delete', ['id' => $item->id_product]),
                ];
                return view('admin._layout.actions', $actions);
            })
            ->editColumn('product_specification', function ($item){
                $array = [];
                foreach ($item->product_specification as $key => $specification){
                    $array[] = '<li>' . $key . ': ' . $specification . '</li>';
                }

                return '<ul class="list-unstyled">' . implode('', $array) . '</ul>';
            })
            ->editColumn('created_at', function ($item){
                return Carbon::parse($item->created_at)->diffForHumans();
            })
            ->editColumn('updated_at', function ($item){
                return Carbon::parse($item->updated_at)->diffForHumans();
            })
            ->rawColumns([
                'actions',
                'product_specification'
            ]);
    }

    public function query($model)
    {
        return $model->newQuery();
    }

    public function html(): Builder
    {
        $builder = $this->builder();
        $builder->setTableId('products-table');
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
            Column::make('product_name')->title(__('admin.label.name')),
            Column::make('product_slug')->title(__('admin.label.slug')),
            Column::make('product_type')->title(__('admin.label.type')),
            Column::make('product_description')->title(__('admin.label.description')),
            Column::make('product_price')->title(__('admin.label.price')),
            Column::make('product_quantity')->title(__('admin.label.quantity')),
            Column::make('product_specification')->title(__('admin.label.specification')),
            Column::make('product_status')->title(__('admin.label.status')),
            Column::make('created_at')->title(__('admin.label.created_at')),
            Column::make('updated_at')->title(__('admin.label.updated_at')),
        ];
    }

    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
