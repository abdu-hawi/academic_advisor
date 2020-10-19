<?php

namespace App\DataTables;

use App\Model\Collect\Student;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable{

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
        if ($this->type == "advisor"){
            return datatables()
                ->eloquent($query)
                ->addColumn('show', 'advisor.students.btn.show')
                ->addColumn('risk', 'advisor.students.btn.risk')
                ->rawColumns([
                    'show',
                    'risk',
                ]);
        }else{
            return datatables()
                ->eloquent($query)
                ->addColumn('show', 'admin.students.btn.show')
                ->addColumn('risk', 'admin.students.btn.risk')
                ->rawColumns([
                    'show',
                    'risk',
                ]);
        }
    }

    /**
     * Get query source of dataTable.
     *
     * @param Student $model
     * @return Builder
     */
    public function query(Student $model)
    {
        if ($this->type == "advisor") {
            return $model->newQuery()->where('advisor_id', advisor()->id())->with('interest');
        }else{
            return $model->newQuery()->with('interest');
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('studentdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('gpa'),
            Column::computed('risk')
                ->title('Risk level')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->className('col-lg-1')
                ->addClass('text-center'),
            Column::make('interest.name')->title('Interest Name'),
            Column::computed('show')
                ->title('Plan')
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
        return 'Student_' . date('YmdHis');
    }
}
