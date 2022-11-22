<?php

namespace App\Http\Controllers;

use App\Audit;
use Morilog\Jalali\Jalalian;
use Illuminate\Http\Request;
use DataTables;

class AuditController extends Controller
{


    public function index()
    {
        $menu = "audit";
        $audit_logs = Audit::orderBy('id', 'DESC')->get();
        return view('panel.audit', compact('audit_logs', 'menu'));
    }

    public function list(Request $request)
    {
        $audit_logs = Audit::orderBy('id', 'DESC')->get();


        if ($request->ajax()) {

            $data = Audit::latest()->get();
            return Datatables::of($data)

                ->addIndexColumn()
                ->addColumn('created_at',function ($row){
                    return jdate($row->created_at)->format('%A, %d %B %Y,%H:%M');
                })

                ->rawColumns(['created_at'])
                ->make(true);
        }

    }


    public function destroy(Audit $audit)
    {

        try {
            $audit->delete();
        } catch (Exception $exception) {
            return redirect(route('audit'))->with('warning', $exception->getCode());
        }
        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('audit'))->with('success', $msg);
    }

}
