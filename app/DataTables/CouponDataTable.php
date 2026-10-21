<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Coupon> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.coupons.edit', $query->id) . "' class='btn btn-warning me-2' title='Edit Coupon'>
                    <i class='fas fa-edit'></i> Edit
                </a> ";

                $delete = "<a href='" . route('admin.coupons.destroy', $query->id) . "' class='btn btn-danger delete_btn' title='Delete Coupon'>
                    <i class='fas fa-trash'></i> Delete
                </a>";

                return '<div class="d-flex gap-2 justify-content-center">' . $edit . $delete . '</div>';
            })
            ->editColumn('name', function ($query) {
                return '<strong>' . e($query->name) . '</strong>';
            })
            ->editColumn('code', function ($query) {
                return '<span class="badge badge-info px-3 py-2 font-weight-bold">' . e($query->code) . '</span>';
            })
            ->editColumn('discount', function ($query) {
                return $query->discount_type === 'percent' ? $query->discount . '%' : currencyPosition($query->discount);
            })
            ->editColumn('status', function ($query) {
                return $query->status === 'active' ?
                    '<span class="badge badge-success px-3 py-2">Active</span>'
                    :
                    '<span class="badge badge-danger px-3 py-2">Deactive</span>';
            })
            ->rawColumns(['action', 'name', 'code', 'discount', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Coupon>
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('coupon-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(60)->addClass('text-center'),
            Column::make('name'),
            Column::make('code'),
            Column::make('quantity')->title('Qty')->addClass('text-center'),
            Column::make('discount')->title('Discount')->addClass('text-center'),
            Column::make('expire_date')->title('Expire Date')->addClass('text-center'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupon_' . date('YmdHis');
    }
}
