<?php

namespace App\DataTables;

use App\Models\Inbox;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Column;
use Carbon\Carbon;
use Log;
class InboxDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        Log::info($query->toSql());// Log::info(print_r($query, true));
        $dataTable = new EloquentDataTable($query);
       
        // return $dataTable->editColumn('created_at', '$dataTable->created_at')
        // ->addColumn('action', 'inboxes.datatables_actions');

         return $dataTable->editColumn('created_at', function ($result) {
            if($result->created_at == null)
            {
                
                return $result->created_at ?  : 'Unknown';
                //return  'Unknown';
            }
                Carbon::setLocale('vi');
                return $result->created_at->format('d-m-Y - H:i:s');
                //return $result->created_at->format('d/M/Y - H:i:s');
            })
         ->addColumn('action', 'inboxes.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Inbox $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inbox $model)
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
                'order'     => [[5, 'desc']],
                'buttons'   => [
                     //['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                     ['extend' => 'export', 'text' => 'Xuất file', 'className' => 'btn btn-default btn-sm no-corner',],
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
        // $users = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at']);
        // return DataTables::of($users)->make(true);

        return [
            // 'id',
            // 'hash' => ['searchable' => false],
            // ('name'),
            // 'contact_id',
            // 'size',
            // 'path',
            // 'created_at',
            // 'type'
            //['data' => 'id','title'=>'ID của file'],
            ['data' => 'name','title'=>'Tên thư đến'],
            ['data' => 'contact_id','title'=>'Mã nơi gửi'],
            ['data' => 'size','title'=>'Kích thước file'],
            ['data' => 'path','title'=>'Thư mục lưu'],
            ['data' => 'type','title'=>'Kiểu nhận về'],
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
        return 'inboxes_datatable_' . time();
    }

    // TuanAnh
    protected $table="datatables_data";
}
