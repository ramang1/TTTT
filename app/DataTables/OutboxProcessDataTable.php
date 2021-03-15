<?php

namespace App\DataTables;

use App\Models\OutboxProcess;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class OutboxProcessDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'outbox_processes.datatables_actions');//->rawColumns(['outbox_processes.datatables_actions', 'process']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OutboxProcess $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OutboxProcess $model)
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'action',
            // 'outbox_id',
            // 'user_id',
            // 'note',
            // 'description'
            ['data' => 'action_type','title'=>'Trạng thái'],
            ['data' => 'outbox_id','title'=>'Mã thư đi'],
            ['data' => 'user_id','title'=>'Mã người gửi'],
            ['data' => 'note','title'=>'Ghi chú'],
            ['data' => 'description','title'=>'Mô tả'],
            ['data' => 'created_at','title'=>'Thời gian'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'outbox_processes_datatable_' . time();
    }
}
