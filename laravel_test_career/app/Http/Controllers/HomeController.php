<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    public function tests()
    {        
        // dd(DB::raw('if(tests.id=testeds.test_id,1,0) as tested'));
        $tests = DB::table(DB::raw('tests,testeds'))
        ->where('testeds.user_id',Auth::id())
        ->select(['tests.*',DB::raw('if(tests.id=testeds.test_id,1,0) as tested')])
        ->get();

        return view('user.tests',[
            'tests'=>$tests,
        ]);
    }

    public function test(Request $request,$id)
    {
        if ($request->isMethod('post')){
            
            // dd();
            $quests = DB::table('quests')
            ->where('test_id',$id)
            ->get();
            $s=0;
            foreach ($quests as $key => $value) {
                foreach ($request->answers as $key1 => $value1) {
                    if($value->numering==$key1)
                    {
                        if($value1==$value->correct){
                            $s+=1;
                            break;
                        }
                    }
                }
            }
            $text=["Ваш набранный балл ".$s."."];
            array_push($text,'Испытуемые, получившие оценку 1-8 балла, характеризуются низким уровнем проявления коммуникативных и организаторских склонностей. ');
            array_push($text,'Набравшие 9-16 баллов имеют коммуникативные и организаторские склонности на уровне ниже среднего. Они не стремятся к общению, предпочитают проводить время наедине с собой. В новой компании или коллективе чувствуют себя скованно. Испытывают трудности в установлении контактов с людьми. Не отстаивают своего мнения, тяжело переживают обиды. Редко проявляют инициативу, избегают принятия самостоятельных решений. ');
            array_push($text,'Для испытуемых, набравших 17-24 баллов, характерен средний уровень проявления коммуникативных и организаторских склонностей. Они стремятся к контактам с людьми, отстаивают свое , однако потенциал их склонностей не отличается высокой устойчивостью. Требуется дальнейшая воспитательная работа по формированию и развитию этих качеств личности. ');
            array_push($text,'Оценка 25-32 баллов свидетельствует о высоком уровне проявления коммуникативных и организаторских склонностей испытуемых. Они не теряются в новой обстановке, быстро находят друзей, стремятся расширить круг своих знакомых, помогают близким и друзьям, проявляют инициативу в общении, способны принимать решения в трудных, нестандартных ситуациях. ');
            array_push($text,'Высший уровень коммуникативных и организаторских склонностей (33-40 баллов) у испытуемых свидетельствует о сформированной потребности в коммуникативной и организаторской деятельности. Они быстро ориентируются в трудных ситуациях. Непринужденно ведут себя в новом коллективе. Инициативны. Принимают самостоятельные решения. Отстаивают свое мнение и добиваются принятия своих решений. Любят организовывать игры, различные мероприятия. Настойчивы и одержимы в деятельности. ');
            // dd($text);
            $tested_id = DB::table('testeds')
            ->insertGetId([
                'test_id'=>$id,
                'user_id'=>Auth::id(),
            ]);
            foreach ($request->answers as $key => $value) {
                $quest_id = DB::table('answereds')
                ->insertGetId([
                    'tested_id'=>$tested_id,
                    'numbering'=>$key,
                    'liter'=>$value,
                ]);
            }

            return redirect("tests")->with(['text'=>$text]);
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
            $quests[$key]->answers = $answers;
        }

        return view('user.test',[
            'test'=>$test,
            'quests'=>$quests,
        ]);
        // return view('user.test');
    }
}
