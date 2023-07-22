<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileUsulan;
use App\Models\Satuan;
use App\Models\TransUsulan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count_satuans = Satuan::count();
        $count_fileUsulan = FileUsulan::count();
        $count_trans = TransUsulan::count();

        return view('admin.dashboard.index', compact('count_satuans', 'count_fileUsulan', 'count_trans'));
    }
}
