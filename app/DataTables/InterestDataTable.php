<?php

namespace App\DataTables;

use App\Model\Interest;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InterestDataTable extends DataTable
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
            ->addColumn('show', 'admin.interest.btn.show')
            ->addColumn('edit', 'admin.interest.btn.edit')
            ->addColumn('delete', 'admin.interest.btn.delete')
            ->rawColumns([
                'show',
                'edit',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Interest $model
     * @return Builder
     */
    public function query(Interest $model)
    {
//        return $model->newQuery();
        return $model->query()->with("course_id")->select('interests.*')->orderBy("id");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('intrestdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                            ->className('btn btn-success')
                            ->text('<i class="fas fa-plus fa-sm"></i> New Interest')
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
            [
                'name'=>'course_id',
                'data'=>'course_id.code',
                'title'=>'Code',
            ],
            [
                'name'=>'course_id',
                'data'=>'course_id.name',
                'title'=>'Course Name',
            ],
            [
                'name'=>'course_id',
                'data'=>'course_id.prerequisite',
                'title'=>'Prerequisite',
            ],
            [
                'name'=>'name',
                'data'=>'name',
                'title'=>'Interested field',
            ],
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
        return 'Intrest_' . date('YmdHis');
    }
}
