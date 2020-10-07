<?php

namespace App\DataTables;

use App\Models\Outbox;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Carbon\Carbon;
class OutboxDataTable extends DataTable
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

        return $dataTable
        ->editColumn('created_at', function ($result) {
            if($result->created_at == null)
            {
                return $result->created_at ?  : 'Unknown';
            }
                Carbon::setLocale('vi');
                return $result->created_at->format('d-M-Y - H:i:s');
            })
        ->addColumn('action', 'outboxes.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Outbox $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Outbox $model)
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
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
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
            // 'hash' => ['searchable' => false],
            // 'name',
            // 'path',
            // 'size',
            // 'type',
            // 'contact_id'
            ['data' => 'id','title'=>'id'],
            ['data' => 'name','title'=>'Tên thư đi'],
            ['data' => 'channel_id','title'=>'Mã nơi nhận'],
            ['data' => 'size','title'=>'Kích thước file'],
            ['data' => 'path','title'=>'Thư mục lưu'],
            ['data' => 'type','title'=>'Kiểu nén'],
            ['data' => 'user_id','title'=>'Id của người thực hiện'],
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
        return 'outboxes_datatable_' . time();
    }
}
