<?php

namespace App\DataTables;

use App\Models\Package;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use App\Traits\DataTableTrait;

class PackageDataTable extends DataTable
{
    use DataTableTrait;
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

            ->editColumn('status', function($query) {
                $status = 'warning';
                switch ($query->status) {
                    case 'active':
                        $status = 'primary';
                        break;
                    case 'inactive':
                        $status = 'warning';
                        break;
                }
                return '<span class="text-capitalize badge bg-'.$status.'">'.$query->status.'</span>';
            })
            ->editColumn('duration_unit', function($package) {
                switch ($package->duration_unit) {
                    case 'monthly':
                        $duration_unit = __('message.monthly');
                        break;
                    case 'yearly':
                        $duration_unit = __('message.yearly');
                        break;
                    default:
                        $duration_unit = $package->duration_unit;
                        break;
                }
                return $duration_unit;
            })
            ->addColumn('price', function($price){             
                $price = getPriceFormat($price->price);
                return $price;
            })
            ->addColumn('action', function($package){
                $id = $package->id;
                return view('package.action',compact('package','id'))->render();
            })
            ->addIndexColumn()
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Package $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Package $model)
    {
        return $model->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
                ->searchable(false)
                ->title(__('message.srno'))
                ->orderable(false),
            ['data' => 'name', 'name' => 'name', 'title' => __('message.name')],
            ['data' => 'duration', 'name' => 'duration', 'title' => __('message.duration')],
            ['data' => 'duration_unit', 'name' => 'duration_unit', 'title' => __('message.duration_unit')],
            ['data' => 'price', 'name' => 'price', 'title' => __('message.price')],
            ['data' => 'status', 'name' => 'status', 'title' => __('message.status')],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->title(__('message.action'))
                  ->width(60)
                  ->addClass('text-center hide-search'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Package' . date('YmdHis');
    }
}