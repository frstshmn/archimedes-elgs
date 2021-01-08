<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function enter_via_code(Request $request)
    {
    	$lessonpass = $request->lessonpass;
        $user_id = $request->user_id;
        $lesson_id = $request->lesson_id;
    	$lessontoken = DB::table('lessons')->where('lesson_id', $request->lesson_id)->value('lesson_password');
        $seed = rand(1, 4);
    	if ($lessontoken == $lessonpass && DB::select('select * from attendance where user_id = ? and lesson_id = ?', [$user_id, $lesson_id]) == NULL)
    	{      
            if(DB::table('lessons')->where('lesson_id', $lesson_id)->value('registration') == 0)
            {
                DB::insert('insert into attendance (lesson_id, user_id, late) values (?, ?, 1)', [$lesson_id, $user_id]);
                return view('lessons.main')->with('lesson_id', $lesson_id);
            }
            else
            {
                DB::insert('insert into attendance (lesson_id, user_id, late) values (?, ?, 0)', [$lesson_id, $user_id]);
                return view('lessons.main')->with('lesson_id', $lesson_id);
            }
    	}
    	elseif ($lessontoken == $lessonpass && DB::select('select * from attendance where user_id = ? and lesson_id = ?', [$user_id, $lesson_id]) != NULL)
    	{
            return view('lessons.main')->with('lesson_id', $lesson_id);
    	}
        else
        {
            return view('errors.403');
        }
    }

    public function answer(Request $request)
    {
        $answer = $request->answer_button_group;
        $question_id = $request->question_id;
        $identifier = $request->identifier;
        $lesson_id = $request->lesson_id;
        if(DB::table('answers')->where('question_id', $question_id)->value('numberzk') == $identifier){
            return view('lessons.main')->with('lesson_id', $lesson_id);
        }
        else{
            DB::insert('insert into answers (answer_id, numberzk, question_id, answer) values (NULL, ?, ?, ?)', [$identifier, $question_id, $answer]);
            return view('lessons.main')->with('lesson_id', $lesson_id);
        }
    }

    public function create_lesson(Request $request)
    {
        $topic = $request->topic;
        $discipline = $request->discipline;
        $group = $request->group;
        $password = $request->password;
        $teacher = $request->teacher;

        DB::insert('insert into lessons (lesson_topic, lesson_password, lesson_discipline, lesson_teacher, lesson_group, active) values (?, ?, ?, ?, ?, 0)', [$topic, $password, $discipline, $teacher, $group]);

        $lesson_id = DB::select('select `lesson_id` from `lessons` where `lesson_password` = '.$password);

        $lesson_id = $lesson_id[0]->lesson_id;


        if($request->question_count != 0){
            for($i = 1; $i <= $request->question_count; $i++)
            {
                $q = 'question_'.$i;
                $c = 'correct_'.$i;
                $a1 = 'answer2_'.$i;
                $a2 = 'answer3_'.$i;
                $a3 = 'answer4_'.$i;

                $correct_count = rand(1, 4);

                switch ($correct_count) {
                    case 1:
                        DB::insert('insert into questions (question, lesson_id, answer_1, answer_2, answer_3, answer_4, correct_answer, is_answered) values (?, ?, ?, ?, ?, ?, ?, 0)', [$request->{$q}, $lesson_id, $request->{$c}, $request->{$a1}, $request->{$a2}, $request->{$a3}, 1]);
                        break;
                    case 2:
                        DB::insert('insert into questions (question, lesson_id, answer_1, answer_2, answer_3, answer_4, correct_answer, is_answered) values (?, ?, ?, ?, ?, ?, ?, 0)', [$request->{$q}, $lesson_id, $request->{$a1}, $request->{$c}, $request->{$a2}, $request->{$a3}, 2]);
                        break;
                    case 3:
                        DB::insert('insert into questions (question, lesson_id, answer_1, answer_2, answer_3, answer_4, correct_answer, is_answered) values (?, ?, ?, ?, ?, ?, ?, 0)', [$request->{$q}, $lesson_id, $request->{$a1}, $request->{$a2}, $request->{$c}, $request->{$a3}, 3]);
                        break;
                    case 4:
                        DB::insert('insert into questions (question, lesson_id, answer_1, answer_2, answer_3, answer_4, correct_answer, is_answered) values (?, ?, ?, ?, ?, ?, ?, 0)', [$request->{$q}, $lesson_id, $request->{$a1}, $request->{$a2}, $request->{$a3}, $request->{$c}, 4]);
                        break;
                }
            }
        }
        
    }

    public function remove_lesson(Request $request)
    {
        DB::delete('delete from lessons where lesson_id = ?', [$request->lesson_id]);
        return view('cabinet.main');
    }

    public function start_lesson(Request $request)
    {
        DB::update('update lessons set active = 1 where lesson_id = ?', [$request->lesson_id]);
        return view('cabinet.main');
    }

    public function stop_lesson(Request $request)
    {
        DB::update('update lessons set active = 0 where lesson_id = ?', [$request->lesson_id]);
        return view('cabinet.main');
    }

    public function get_registered_students(Request $request)
    {

        echo('{"students": [');
        $registered_students = DB::select('SELECT * FROM `attendance` WHERE `lesson_id` = '.$request->lesson_id);
        foreach ($registered_students as $registered_student)
        {
            $users = DB::select('SELECT * FROM `users` WHERE `id` = '.$registered_student->user_id);
            foreach ($users as $user)
            {
                $students = DB::select('SELECT * FROM `students` WHERE `zk_number` = "'.$user->identifier.'"');
                foreach ($students as $student) {
                    echo('"'.$student->surname.' '.$student->name.'", ');
                }
                
            }
            
        }
        echo('" "]}');
    }
    public function report(Request $request)
    {
        return view('cabinet.report')->with('lesson_id', $request->lesson_id);
    }

    public function examss(Request $request){
        $array=[];
        $questions = DB::connection('mysql2')->select('SELECT content FROM questions');
        foreach ($questions as $question)
        {
            array_push($array, preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
                    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
                }, $question->content));
        }

        echo var_dump($array);
    }
    
}