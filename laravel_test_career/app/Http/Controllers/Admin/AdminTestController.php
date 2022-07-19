<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
use Illuminate\Support\Facades\Storage;

class AdminTestController extends Controller
{
    /**
     * Create a test controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function view_tests()
    {
        $tests = DB::table('tests')
        ->get();

        return view('admin.test.tests',[
            'tests'=>$tests,
        ]);
    }

    public function add_test(Request $request)
    {
        if ($request->isMethod('post')){

            $test = new Test();
            $test->name = $request->name;
            $test->pretty_url = $request->pretty_url;
            $test->save();

            return redirect("admin/tests");
        }

        return view('admin.test.add_test');
    }

    public function change_test(Request $request,$id)
    {

        if ($request->isMethod('post')){
            DB::table('tests')
            ->where('id',$id)
            ->update([
                'name'=> $request->name,
                'pretty_url'=> $request->pretty_url,
            ]);
            return redirect("admin/tests");
        }
        $test = DB::table('tests')
        ->where("id",$id)
        ->first();

        return view('admin.test.change_test',[
            'test'=>$test,
        ]);
    }

    public function delete_test($id)
    {
        DB::table('tests')
        ->where('id',$id)
        ->delete();

        return redirect("/admin/tests");
    }
}
