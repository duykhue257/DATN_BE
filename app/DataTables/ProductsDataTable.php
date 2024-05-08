<?php

namespace App\DataTables;

use App\Models\Products;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($prd) {
            return '
                <form class="d-flex" action="' . route('product.destroy', $prd->id) . '" method="POST">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <a class="btn btn-primary mx-2" href="' . route('product.edit', $prd->id) . '">Cập nhật</a>
                    <a class="btn btn-primary mr-2" href="' . route('product.show', $prd->id) . '">Chi tiết</a>
                    <button onclick="return confirm(\'are you sure?\')" class="btn btn-danger" type="submit">Xóa</button>
                </form>
                ';
            })
            ->addColumn('name_cate', function ($prd) {
                return $prd->category->name_cate;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Products $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('products-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0, 'asc')
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title('Tên'),
            Column::make('price')->title('Giá'),
            Column::make('price_reduced')->title('Giảm giá'),
            Column::make('description')->title('Mô tả'),
            column::computed('name_cate')->title('Danh mục'),
            Column::computed('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Products_' . date('YmdHis');
    }
}
