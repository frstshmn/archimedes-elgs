@include('layouts.header')
        <title>{{ DB::table('lessons')->where('lesson_id', $lesson_id)->value('lesson_topic') }} | Archimedes ELGS</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" >
    </head>
    <body class="font-second background-primary">
       
        @include('layouts.navbar')

        <div class="container">
          <div class="row mt-3">
            <div class="col-xs-12 col-md-12">
              <div class="card shadow-lg">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 text-center">
                      <h4 class="card-title font-weight-bold"><span class="font-weight-normal h5">Тема №{{ DB::table('lessons')->where('lesson_id', $lesson_id)->value('lesson_password') }}:</span> {{ DB::table('lessons')->where('lesson_id', $lesson_id)->value('lesson_topic') }}</h4>
                      <p class="card-text">{{ DB::table('lessons')->where('lesson_id', $lesson_id)->value('lesson_discipline') }}</p>
                    </div>
                  </div>
                  <div class="row mt-5">

                    <?php $id = 0; ?>
                    @foreach(DB::select('select * from `questions` where lesson_id = ? and is_answered = 0', [$lesson_id]) as $question)
                      <?php $id += 1; ?>

                      @if (DB::table('answers')->where('numberzk', Auth::user()->identifier)->value('question_id') === $question->question_id)
                        <div class="col-xs-6 col-md-3">
                          <button type="button" class="btn btn-secondary p-5 font-weight-bold" data-toggle="modal" data-target="#question{{ $question->question_id }}" disabled>Тест №{{ DB::table('lessons')->where('lesson_group', DB::table('students')->where('zk_number', Auth::user()->identifier)->value('groupnumber'))->value('lesson_password') }}0{{ $id }}<br>Відповідь дана</button>
                        </div>
                      @else
                      
                      <div class="col-xs-6 col-md-3">
                        <button class="btn btn-info p-5 font-weight-bold" data-toggle="modal" data-target="#question{{ $question->question_id }}">Тест №{{ DB::table('lessons')->where('lesson_group', DB::table('students')->where('zk_number', Auth::user()->identifier)->value('groupnumber'))->value('lesson_password') }}0{{ $id }}</button>
                      </div>

                      <div class="modal fade shadow-lg" id="question{{ $question->question_id }}" tabindex="-1" role="dialog" aria-labelledby="question_{{ $question->question_id }}-modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <form action="{{ route('answer') }}" method="post" id="form{{ $question->question_id }}">
                              {{ csrf_field() }}
                                <div class="modal-body">
                                        <div class="custom-control custom-radio">
                                          <input type="radio" id="answer1" name="answer_button_group" value="1" class="custom-control-input">
                                          <label class="custom-control-label" id="answer1_label" for="answer1">{{ $question->answer_1 }}</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                          <input type="radio" id="answer2" name="answer_button_group" value="2" class="custom-control-input">
                                          <label class="custom-control-label" id="answer2_label" for="answer2">{{ $question->answer_2 }}</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                          <input type="radio" id="answer3" name="answer_button_group" value="3" class="custom-control-input">
                                          <label class="custom-control-label" id="answer3_label" for="answer3">{{ $question->answer_3 }}</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                          <input type="radio" id="answer4" name="answer_button_group" value="4" class="custom-control-input">
                                          <label class="custom-control-label" id="answer4_label" for="answer4">{{ $question->answer_4 }}</label>
                                        </div>
                                    <input type="text" class="form-control" name="lesson_id" id="lesson_id" value="{{ $lesson_id }}" hidden>
                                    <input type="text" class="form-control" name="question_id" id="question_id" value="{{ $question->question_id }}" hidden>
                                    <input type="text" class="form-control" name="identifier" value="{{ Auth::user()->identifier }}" hidden>
                                  <div class="progress mt-2">
                                    <div id="progress{{ $question->question_id }}" class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuemin="0" aria-valuemax="10"></div>
                                  </div>
                                </div>
                                
                                <div class="modal-footer text-center">
                                  <button type="submit" id="button{{ $question->question_id }}" class="btn btn-primary col-12" id="submitbutton">Відповісти</button>
                                </div>  
                            </form>
                          </div>
                        </div>
                      </div>
                      <script type="text/javascript">
                        $('#question{{ $question->question_id }}').on('shown.bs.modal', function (e) {
                          let counter = 100;
                          let timer = setInterval(function (){
                            counter -= 1;
                            $('#progress{{ $question->question_id }}').css('width', counter + "%");
                            console.log(counter);
                            if (counter < 30)
                            {
                              $('#progress{{ $question->question_id }}').removeClass('bg-success');
                              $('#progress{{ $question->question_id }}').addClass('bg-danger');
                            }

                            if (counter == 0){
                              $('form#form{{ $question->question_id }}').submit();
                              clearInterval(timer);
                            }
                          }, 200);
                        })

                      </script>
                      @endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </body>
</html>