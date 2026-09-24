<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Slider> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.sliders.edit', $query->id) . "' class='btn btn-warning me-2' title='Edit Slider'>
                    <i class='fas fa-edit'></i> edit
                </a>";

                $delete = "<a href='" . route('admin.sliders.destroy', $query->id) . "' class='btn btn-danger delete_btn' title='Delete Slider'>
                    <i class='fas fa-trash'></i> delete
                </a>";

                return '<div class="d-flex gap-2 justify-content-center">' . $edit . $delete . '</div>';
            })
            ->editColumn('image', function ($query) {
                return '<img width="80" height="50" src="' . asset($query->image) . '" alt="' . e($query->title) . '" class="rounded shadow-sm" style="object-fit: cover;" />';
            })
            ->editColumn('status', function ($query) {
                return $query->status
                    ? '<span class="badge badge-success px-3 py-2">Active</span>'
                    : '<span class="badge badge-secondary px-3 py-2">Inactive</span>';
            })
            ->editColumn('title', function ($query) {
                return '<strong>' . e($query->title) . '</strong>';
            })
            ->rawColumns(['action', 'image', 'status', 'title'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Slider>
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
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
            Column::make('image')->width(100),
            Column::make('title'),
            Column::make('sub_title'),
            Column::make('status')->width(100),
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
        return 'Slider_' . date('YmdHis');
    }
}
