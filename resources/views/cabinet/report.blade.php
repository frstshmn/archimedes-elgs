@include('layouts.header')
        <title>{{ DB::table('lessons')->where('lesson_id', $lesson_id)->value('lesson_topic') }} | Archimedes ELGS</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" >
    </head>
    <body class="font-second background-primary">
        <div class="container">
            <table class="table table-striped table-light">
              <thead>
                <tr>
                  <th>ПІБ</th>
                  @foreach(DB::select('select * from `questions` where lesson_id = ?', [$lesson_id]) as $question)
                    <th>{{$question->question}}</th>
                  @endforeach
                  <?php
                    //$count = DB::table('questions')->where('lesson_id', $lesson_id)->count('question_id');
                    //for ($i=1; $i <= $count; $i++) { 
                      //echo ('<th>Питання №'.$i.'</th>');
                    //}
                  ?>
                </tr>
              </thead>
              <tbody>
                @foreach(DB::select('select * from `answers` INNER JOIN `questions` ON answers.question_id = questions.question_id where questions.lesson_id = ?', [$lesson_id]) as $question)
                    <tr>
                      <td>
                        {{ DB::table('students')->where('zk_number', $question->numberzk)->value('surname') }}
                        {{ DB::table('students')->where('zk_number', $question->numberzk)->value('name') }}
                      </td>
                      @foreach(DB::select('select * from `answers` INNER JOIN `questions` ON answers.question_id = questions.question_id where questions.lesson_id = ? and numberzk = ?', [$lesson_id, $question->numberzk]) as $answer)
                        @if ($answer->answer === $answer->correct_answer)
                          <td class="text-success">{{ $answer->{'answer_'.$answer->answer} }}</td>
                        @elseif ($answer->answer != $answer->correct_answer)
                          <td class="text-danger">{{ $answer->{'answer_'.$answer->answer} }}</td>
                        @else
                          <td class="text-warning font-weight-bold">Відповідь не дана</td>
                        @endif
                        
                      @endforeach
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </body>