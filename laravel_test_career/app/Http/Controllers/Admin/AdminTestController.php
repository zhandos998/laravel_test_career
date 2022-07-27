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

    public function test($id)
    {
        $test = DB::table('tests')
        ->where("id",$id)
        ->first();

        $quests = DB::table('quests')
        ->where("test_id",$id)
        ->orderBy('numering')
        ->get();
        // dd($quests);
        foreach ($quests as $key => $value) {
            $answers = DB::table('answers')
            ->where("quest_id",$value->id)
            ->get();
            $quests[$key]->answers = $answers;
        }

        $users = DB::table('testeds')
        ->where("test_id",$id)
        ->join("users",'users.id','testeds.user_id')
        ->select('users.*','testeds.id as tested_id')
        ->get();

        foreach ($users as $key => $value) {
            $answereds = DB::table('answereds')
            ->where("tested_id",$value->tested_id)
            ->orderBy('numbering')
            ->get();
            // dd($answereds);
            $users[$key]->answereds = $answereds;
        }

        return view('admin.test.test',[
            'test'=>$test,
            'quests'=>$quests,
            'users'=>$users,
            
        ]);
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
            // dd($request);
            $test = new Test();
            $test->name = $request->name;
            $test->save();
            foreach ($request->question as $key => $value) {
                $quest_id = DB::table('quests')
                ->insertGetId([
                    'test_id'=>$test->id,
                    'quest'=>$value['name'],
                    'numering'=>$key,
                    'correct'=>$request->answer[$key][$value['correct']]['liter'],
                ]);
                foreach ($request->answer[$key] as $value_answer) {
                    DB::table('answers')
                    ->insert(['quest_id'=>$quest_id,'answer'=>$value_answer['answer'],'liter'=>$value_answer['liter']]);
                }
            }
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
            ]);
            
            DB::table('quests')
            ->where('test_id',$id)
            ->delete();

            foreach ($request->question as $key => $value) {
                $quest_id = DB::table('quests')
                ->insertGetId(['test_id'=>$id,'quest'=>$value]);
                foreach ($request->answer[$key] as $value_answer) {
                    DB::table('answers')
                    ->insert(['quest_id'=>$quest_id,'answer'=>$value_answer['answer'],'liter'=>$value_answer['liter']]);
                }
            }
            return redirect("admin/tests");
        }
        $test = DB::table('tests')
        ->where("id",$id)
        ->first();

        $quests = DB::table('quests')
        ->where("test_id",$id)
        ->get();
        foreach ($quests as $key => $value) {
            $answers = DB::table('answers')
            ->where("quest_id",$value->id)
            ->get();
            // dd($answers);
            $quests[$key]->answers = $answers;
        }
        // dd($quests);
        return view('admin.test.change_test',[
            'test'=>$test,
            'quests'=>$quests,
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
