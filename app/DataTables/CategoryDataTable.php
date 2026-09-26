<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Category> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.categories.edit', $query->id) . "' class='btn btn-warning me-2' title='Edit Category'>
                    <i class='fas fa-edit'></i> Edit
                </a>";

                $delete = "<a href='" . route('admin.categories.destroy', $query->id) . "' class='btn btn-danger delete_btn' title='Delete Category'>
                    <i class='fas fa-trash'></i> Delete
                </a>";

                return '<div class="d-flex gap-2 justify-content-center">' . $edit . $delete . '</div>';
            })
            ->editColumn('name', function ($query) {
                return '<strong>' . e($query->name) . '</strong>';
            })
            ->editColumn('slug', function ($query) {
                return '<code class="text-muted">' . e($query->slug) . '</code>';
            })
            ->editColumn('show_at_home', function ($query) {
                return $query->show_at_home
                    ? '<span class="badge badge-success px-3 py-2">Yes</span>'
                    : '<span class="badge badge-secondary px-3 py-2">No</span>';
            })
            ->editColumn('status', function ($query) {
                return $query->status
                    ? '<span class="badge badge-success px-3 py-2">Active</span>'
                    : '<span class="badge badge-secondary px-3 py-2">Inactive</span>';
            })
            ->rawColumns(['action', 'name', 'slug', 'show_at_home', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Category>
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
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
            Column::make('name'),
            Column::make('slug'),
            Column::make('show_at_home')->width(120)->title('Show at Home'),
            Column::make('status')->width(100),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(180)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
