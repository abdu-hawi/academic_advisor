<?php

namespace App\DataTables;

use App\Http\Controllers\Advisor\ExamController;
use App\Model\Collect\Exam;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExamDataTable extends DataTable
{

    private $type;

    public function __construct($type){
        $this->type = $type;
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        if ($this->type == "advisor") {
            return datatables()
                ->eloquent($query)
                ->addColumn('edit', 'advisor.exams.btn.edit')
                ->addColumn('delete', 'advisor.exams.btn.delete')
                ->rawColumns([
                    'edit',
                    'delete',
                ]);
        }else{
            return datatables()
                ->eloquent($query)
                ->addColumn('edit', 'admin.exams.btn.edit')
                ->addColumn('delete', 'admin.exams.btn.delete')
                ->rawColumns([
                    'edit',
                    'delete',
                ]);
        }
    }

    /**
     * Get query source of dataTable.
     *
     * @param Exam $model
     * @return Builder
     */
    public function query(Exam $model)
    {
        return $model->newQuery();//->with('course')->select('exams.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        if ($this->type == "advisor") {
            return $this->builder()
                ->setTableId('examdatatable-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom('Bfrtip')
                ->orderBy(1)
                ->buttons(
                    Button::make('create')
                        ->className('btn btn-success')
                        ->text('<i class="fas fa-plus fa-sm"></i> Create new Event')
                );
        }else{
            return $this->builder()
                ->setTableId('examdatatable-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom('Bfrtip')
                ->orderBy(1)
                ->buttons(
                    Button::make('excel')
                        ->className('btn btn-success')
                        ->text('<i class="fas fa-file-excel fa-sm"></i>'),
                        Button::make('print')
                        ->className('btn btn-primary ml-2')
                        ->text('<i class="fas fa-print fa-sm"></i>')
                );
        }
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name')->title('Event Name'),
//            [
//                'name'=>'course.name',
//                'data'=>'course.name',
//                'title'=>'Event Name',
//            ],
            Column::make('date')->className("text-center"),
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
        return 'Exam_' . date('YmdHis');
    }
}
