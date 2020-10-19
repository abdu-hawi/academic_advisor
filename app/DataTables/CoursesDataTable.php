<?php

namespace App\DataTables;

use App\Model\Course;
use App\Model\Prerequisite;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
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
            ->addColumn('show', 'admin.courses.btn.show')
            ->addColumn('edit', 'admin.courses.btn.edit')
            ->addColumn('delete', 'admin.courses.btn.delete')
            ->rawColumns([
                'show',
                'edit',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Course $model
     * @return Builder
     */
    public function query(Course $model)
    {
//        return $model->newQuery();
        return $model->query()->orderBy("id");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('coursesdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
//                    ->buttons(
//                        Button::make('create'),
//                        Button::make('export'),
//                        Button::make('print'),
//                        Button::make('reset'),
//                        Button::make('reload')
//                    );
                    ->buttons(
                        Button::make('create')
                            ->className('btn btn-success')
                            ->text('<i class="fas fa-plus fa-sm"></i> Create new Course')
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
            Column::make('code')->className("text-center"),
            Column::make('name')->className("text-center"),
            Column::make('credit')->className("text-center"),
            Column::make('prerequisite')->className("text-center"),
            Column::make('type')->className("text-center"),
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
        return 'Courses_' . date('YmdHis');
    }
}
