<?php

namespace App\DataTables;

use App\Model\Collect\Advisor;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdvisorsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('show', 'admin.advisor.btn.show')
            ->addColumn('edit', 'admin.advisor.btn.edit')
            ->addColumn('delete', 'admin.advisor.btn.delete')
            ->rawColumns([
                'show',
                'edit',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Advisor $model
     * @return Builder
     */
    public function query(Advisor $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('advisorsdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                            ->className('btn btn-success')
                            ->text('<i class="fas fa-plus fa-sm"></i> Create new Advisor')
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
            Column::make('name')->className("text-center"),
            Column::make('email')->className("text-center"),
            Column::make('phone')->className("text-center"),
            Column::make('number_of_student')->className("text-center")->title("Number of students"),
            Column::computed('show')
                ->title('Show')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->className('col-lg-1')
                ->addClass('text-center'),
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
        return 'Advisors_' . date('YmdHis');
    }
}
