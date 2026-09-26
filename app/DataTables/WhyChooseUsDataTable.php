<?php

namespace App\DataTables;

use App\Models\WhyChooseU;
use App\Models\WhyChooseUs;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WhyChooseUsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<WhyChooseU> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.why-choose-us.edit', $query->id) . "' class='btn btn-warning me-2' title='Edit Item'>
                    <i class='fas fa-edit'></i> edit
                </a>";

                $delete = "<a href='" . route('admin.why-choose-us.destroy', $query->id) . "' class='btn btn-danger delete_btn' title='Delete Item'>
                    <i class='fas fa-trash'></i> delete
                </a>";

                return '<div class="d-flex gap-2 justify-content-center">' . $edit . $delete . '</div>';
            })
            ->editColumn('icon', function ($query) {
                return "<i class='" . $query->icon . "' style='font-size:40px; color: #1b1b18;' />";
            })
            ->editColumn('status', function ($query) {
                return $query->status == 1
                    ? '<span class="badge badge-success px-3 py-2">Active</span>'
                    : '<span class="badge badge-secondary px-3 py-2">Inactive</span>';
            })
            ->editColumn('title', function ($query) {
                return '<strong>' . e($query->title) . '</strong>';
            })
            ->rawColumns(['action', 'icon', 'status', 'title'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<WhyChooseU>
     */
    public function query(WhyChooseUs $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('why-choose-us-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(60),
            Column::make('icon')->width(100)->addClass('text-center'),
            Column::make('title'),
            Column::make('short_description')->title('Description'),
            Column::make('status')->width(100)->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'WhyChooseUs_' . date('YmdHis');
    }
}
