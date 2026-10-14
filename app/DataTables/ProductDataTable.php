<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Product> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.products.edit', $query->id) . "' class='btn btn-warning me-2' title='Edit Product'>
                    <i class='fas fa-edit'></i> Edit
                </a>";

                $delete = "<a href='" . route('admin.products.destroy', $query->id) . "' class='btn btn-danger me-2 delete_btn' title='Delete Product'>
                    <i class='fas fa-trash'></i> Delete
                </a>";

                $more = "<div class='dropdown dropleft d-inline'>
                    <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-no-caret' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' title='More Actions'>
                        <i class='fas fa-ellipsis-v'></i>
                    </button>
                    <div class='dropdown-menu'>
                        <a class='dropdown-item' href='" . route('admin.product-gallery.show-index', $query->id) . "'>
                            <i class='fas fa-images'></i> Product Gallery
                        </a>
                    </div>
                </div>";

                return '<div class="d-flex gap-2 justify-content-center align-items-center">' . $edit . $delete . $more . '</div>';
            })
            ->editColumn('main_image', function ($query) {
                try {
                    $imagePath = $query->main_image ?? '/uploads/default-product.jpg';
                    return '<img width="80" height="50" src="' . asset($imagePath) . '" alt="' . e($query->name) . '" class="rounded shadow-sm" style="object-fit: cover;" onerror="this.src=\'' . asset('/admin/assets/img/avatar/avatar-1.png') . '\'" />';
                } catch (\Exception $e) {
                    return '<span class="text-muted">No Image</span>';
                }
            })
            ->editColumn('name', function ($query) {
                return '<strong>' . e($query->name) . '</strong>';
            })
            ->editColumn('category_id', function ($query) {
                try {
                    if ($query->category) {
                        return '<span class="badge badge-info px-3 py-2">' . e($query->category->name) . '</span>';
                    }
                    return '<span class="badge badge-secondary px-3 py-2">Uncategorized</span>';
                } catch (\Exception $e) {
                    \Log::error('Category error: ' . $e->getMessage());
                    return '<span class="badge badge-secondary px-3 py-2">Error</span>';
                }
            })
            ->editColumn('price', function ($query) {
                return '<strong class="text-success">$' . number_format($query->price, 2) . '</strong>';
            })
            ->editColumn('offer_price', function ($query) {
                try {
                    if ($query->offer_price > 0) {
                        // Calculate discount percentage inline
                        $discount = 0;
                        if ($query->price > 0) {
                            $discount = (int) round((($query->price - $query->offer_price) / $query->price) * 100);
                        }
                        return '<span class="text-danger"><strong>$' . number_format($query->offer_price, 2) . '</strong> <small>(' . $discount . '% off)</small></span>';
                    }
                    return '<span class="text-muted">-</span>';
                } catch (\Exception $e) {
                    return '<span class="text-muted">-</span>';
                }
            })
            ->editColumn('status', function ($query) {
                return $query->status
                    ? '<span class="badge badge-success px-3 py-2">Active</span>'
                    : '<span class="badge badge-secondary px-3 py-2">Inactive</span>';
            })
            ->editColumn('show_at_home', function ($query) {
                return $query->show_at_home
                    ? '<span class="badge badge-success px-3 py-2">Yes</span>'
                    : '<span class="badge badge-secondary px-3 py-2">No</span>';
            })
            ->rawColumns(['action', 'main_image', 'name', 'category_id', 'price', 'offer_price', 'status', 'show_at_home'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Product>
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->with('category')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
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
            Column::make('id')->width(60)->title('ID'),
            Column::make('main_image')->width(100)->title('Image'),
            Column::make('name'),
            Column::make('category_id')->width(120)->title('Category'),
            Column::make('price')->width(100)->title('Price'),
            Column::make('offer_price')->width(120)->title('Offer Price'),
            Column::make('status')->width(100)->title('Status'),
            Column::make('show_at_home')->width(120)->title('Show at Home'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(220)
                ->addClass('text-center')
                ->title('Actions'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
