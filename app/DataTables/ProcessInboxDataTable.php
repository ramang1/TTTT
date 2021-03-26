<?php

namespace App\DataTables;

use App\Models\ProcessInbox;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Models\Inbox;
use DB;
use Carbon\Carbon;

class ProcessInboxDataTable extends DataTable
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
        ->addColumn('action', 'process_inboxes.datatables_actions')
        ->editColumn('inboxes_id', function ($resultInbox) {
            $idInbox = $resultInbox->inboxes_id;
            $Inbox = Inbox::where('id', '=', $idInbox)->pluck('name');
            return $Inbox[0];
        })
        ->editColumn('user_id', function ($resultUser) {
            $idUser = $resultUser->user_id;
            $User = DB::table('users')->where('id', '=', $idUser)->pluck('name');
            return $User[0];
        })
        ->editColumn('created_at', function ($data) {
            if($data->created_at == null) {
                return $data->created_at ?  : 'Unknown';
            }
                Carbon::setLocale('vi');
                return $data->created_at ? with(new Carbon($data->created_at))->diffForHumans() : '';
            })
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProcessInbox $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProcessInbox $model)
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
            // 'inbox_id',
            // 'user_id',
            // 'note',
            // 'description',
            ['data' => 'action_type','title'=>'Trạng thái'],
            ['data' => 'inboxes_id','title'=>'Tên thư đến'],
            ['data' => 'user_id','title'=>'Tên người gửi'],
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
        return 'process_inboxes_datatable_' . time();
    }
}
