<?php

namespace App\DataTables;

use App\Models\Service;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ServiceDataTable extends DataTable
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



        return $dataTable->editColumn('status', function ($result) {

            $commandCMD = $result->path;
            $commandCMD = sprintf($commandCMD, 'status');
            $process = new Process([$commandCMD]);
            $process->run();          
            // executes after the command finishes
            if (!$process->isSuccessful()) {
                return '<span class="label label-warning">Dịch vụ không tồn tại '. $process->getOutput().'</span>';
            }

            foreach ($process as $type => $data) {
                if ($process::OUT === $type) {            
                    
                    if (strpos($data, 'active (running)') !== false) {
                        return '<span class="label label-success">Đang chạy</span>';
                    }
                } else { 
                    return sprintf('<span class="label label-danger">%s</span>', $data. ' '. $commandCMD);
                }
            }
            return  '<span class="label label-danger">Stop</span>';
            
        })
            ->rawColumns(['status', 'action'])
            ->addColumn('action', 'services.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Service $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Service $model)
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
            ->addAction(['width' => '160px', 'printable' => false])
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
            'name',
            'status',
            'note',
            'path'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'services_datatable_' . time();
    }
}
