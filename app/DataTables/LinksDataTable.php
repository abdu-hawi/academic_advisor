<?php

namespace App\DataTables;

use App\Model\Admin\Link;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LinksDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('edit', 'admin.links.btn.edit')
            ->addColumn('delete', 'admin.links.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @return Builder
     */
    public function query()
    {
        return Link::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('linksdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Btp')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                            ->className('btn btn-success')
                            ->text('<i class="fas fa-plus fa-sm"></i> Create new Link')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('title')->name('title')->title('Title'),
            Column::make('url')->name('url')->title('Link'),
            Column::computed('edit')
                ->title('Edit')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->className('col-lg-1')
                ->addClass('text-center'),
            Column::computed('delete')
                ->title('Delete')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->className('col-lg-1')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Links_' . date('YmdHis');
    }
}
