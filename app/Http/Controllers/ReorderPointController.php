<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\DataBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReorderPointController extends Controller
{

    public function index()
    {
        $data['page_title'] = 'Reorder Point';

        $leadTime = 7; // Lead time in days.
        $allProduct = DataBarang::get();
        
        $data['array_result'] = [];
        foreach ($allProduct as $p) {
            
            if ($p) {
                $maxUsage = $this->calculateMaxUsageForProduct($p);
                $avg_usage = $this->calculateAverageQuantitySoldForProduct($p);
                $safetyStock = ($maxUsage - $avg_usage) * $leadTime;
                $demand = $this->calculateDemandForProduct($p);
                $reorderPoint = $leadTime * $demand + $safetyStock;
    
                // Get the current date for the order
                $orderDate = Carbon::now()->toDateString();
    
                // Calculate the quantity to be ordered
                $quantityToOrder = max(0, round($reorderPoint) - $p->stok);
    
                $status = ($quantityToOrder == 0) ? 'Aman' : 'Harus Order';
                $dt['kode_biji_kopi'] = $p->kode_barang;
                $dt['jenis_biji_kopi'] = $p->nama_barang;
                $dt['lead_time'] = $leadTime;
                $dt['avg_usage'] = $avg_usage;
                $dt['max_usage'] = $maxUsage;
                $dt['safety_Stock'] = round($safetyStock);
                $dt['demand'] = $demand;
                $dt['stok_barang'] = $p->stok;
                $dt['reorder_point'] = round($reorderPoint);
                $dt['quantity_to_order'] = $quantityToOrder;
                $dt['status'] = $status;
                // $dt['order_date'] = $quantityToOrder == 0 ? '-' : $orderDate;

                array_push($data['array_result'],$dt);
            }
        }

		return view('reorder.index',$data);

        // return response()->json([
        //     'msg' => 'berhasil',
        //     'data' => $data['array_result'],
        // ]);
    }

    protected function calculateMaxUsageForProduct($product)
    {
        // For simplicity, assume max usage is based on historical sales data.
        $maxUsage = BarangKeluar::where('id_barang', $product->id)->max('qty');

        return $maxUsage;
    }

    protected function calculateDemandForProduct($product)
    {
        // For simplicity, assume demand is based on the average quantity sold per working day.
        $totalQuantitySold = $this->getTotalQuantitySoldForProduct($product);
        $totalDaysWorked = $this->getTotalDaysWorkedForProduct($product);

        // Avoid division by zero
        if ($totalDaysWorked == 0) {
            return 0;
        }

        // Calculate demand per working day.
        $demand = $totalQuantitySold / $totalDaysWorked;

        return $demand;
    }

    protected function calculateAverageQuantitySoldForProduct($product)
    {
        // For simplicity, assume quantity sold is based on historical sales data.
        $totalQuantitySold = $this->getTotalQuantitySoldForProduct($product);
        $totalDaysWorked = $this->getTotalDaysWorkedForProduct($product);

        // Avoid division by zero
        if ($totalDaysWorked == 0) {
            return 0;
        }

        // Calculate average quantity sold per working day.
        $averageQuantitySold = $totalQuantitySold / $totalDaysWorked;

        return $averageQuantitySold;
    }

    protected function getTotalQuantitySoldForProduct($product)
    {
        return BarangKeluar::where('id_barang', $product->id)->sum('qty');
    }

    protected function getTotalDaysWorkedForProduct($product)
    {
        return BarangKeluar::where('id_barang', $product->id)->count();
    }
}
