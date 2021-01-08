        <div class="container" style="margin-top:10px;">
          <div class="row">
            <div class="col-xs-12 col-md-6" style="margin-bottom:10px;">
              <div class="card shadow-lg">
                <div class="card-body">
                  <h5 class="card-title">{{ DB::table('teachers')->where('tab_number', Auth::user()->identifier)->value('surname') }} {{ DB::table('teachers')->where('tab_number', Auth::user()->identifier)->value('name') }} {{ DB::table('teachers')->where('tab_number', Auth::user()->identifier)->value('fathername') }}</h5>
                  <p class="card-text">Керівник групи {{ DB::table('teachers')->where('tab_number', Auth::user()->identifier)->value('groupnumber') }}</p>
                  <div class="list-group shadow-lg rounded" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal" data-target="#addlesson-modal">+ Створити заняття</a>
                    {{-- <a class="list-group-item list-group-item-action list-group-item-light">Повідомлення</a>
                    <a class="list-group-item list-group-item-action list-group-item-light">Налаштування</a> --}}
                    <a class="list-group-item list-group-item-action list-group-item-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Вихід</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-md-6">
              <ul class="list-group">
                <li class="list-group-item list-group-item-primary">
                  <h5 class="mb-0">Створені заняття</h5>
                </li>
                  @foreach (DB::table('lessons')->where('lesson_teacher', Auth::user()->identifier)->get() as $lesson)
                    <a class="list-group-item list-group-item-action rounded-15 shadow-lg">
                      <div class="row">
                        <div class="col-8">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="font-weight-bold">{{ $lesson->lesson_topic }}</h5>
                          </div>
                          <p class="text-muted">{{ $lesson->lesson_discipline }}</p>
                          <p>Код: <span class="text-success">{{ $lesson->lesson_password }}</span></p>
                        </div>
                        <div class="col-4 text-dark text-right">
                          @if ($lesson->active == 1)
                            <form method="post" action="{{ route('stoplesson') }}">
                              {{ csrf_field() }}
                              <input type="text" class="form-control" autocomplete="off" name="lesson_id" value="{{ $lesson->lesson_id }}" hidden>
                              <button class="border-0 bg-transparent" type="submit"><i class="hover-red m-2 cursor-pointer color-dark-grey fas fa-stop border-0 bg-transparent"></i></button>
                            </form>
                          @else
                            <form method="post" action="{{ route('startlesson') }}">
                              {{ csrf_field() }}
                              <input type="text" class="form-control" autocomplete="off" name="lesson_id" value="{{ $lesson->lesson_id }}" hidden>
                              <button class="border-0 bg-transparent" type="submit"><i class="hover-green m-2 cursor-pointer color-dark-grey fas fa-play border-0 bg-transparent"></i></button>
                            </form>
                            <form method="post" action="{{ route('removelesson') }}">
                              {{ csrf_field() }}
                              <input type="text" class="form-control" autocomplete="off" name="lesson_id" value="{{ $lesson->lesson_id }}" hidden>
                              <button class="border-0 bg-transparent" type="submit"><i class="hover-red m-2 cursor-pointer color-dark-grey fas fa-trash-alt border-0 bg-transparent"></i></button>
                            </form>
                          @endif
                          
                        </div>
                      </div>
                      <div class="row text-muted">
                        <div class="col-6">
                          <small></small>
                        </div>
                        <div class="col-6 text-right">
                          <small>Група {{$lesson->lesson_group}}</small>
                        </div>
                      </div>
                      @if ($lesson->active == 1)
                        <div class="progress m-2 mt-3">
                          <div class="progress-bar progress-bar-striped progress-bar-animated bg-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-center text-success mb-2">Запущено</p>
                        <a class="btn btn-success shadow-lg text-white mb-2" data-toggle="modal" data-target="#question-modal">Панель керування</a>

                        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myHugeModalLabel" aria-hidden="true" id="question-modal">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-body">
                                  <h5 class="text-center">Запитання</h5>
                                @foreach(DB::table('questions')->where('lesson_id', $lesson->lesson_id)->get() as $question)
                                  <p>{{$question->question}}</p>
                                @endforeach
                                  <h4 class="text-center">Присутні на занятті</h4>
                                  <div id="registered_students">
                                    
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      @else
                        <form action="{{ route('report') }}" method="POST">
                          {{ csrf_field() }}
                          <input type="text" class="form-control" name="lesson_id" id="lesson_id" value="{{ $lesson->lesson_id }}" hidden>
                          <button class="btn btn-info shadow-lg text-white mb-2" type="submit">Переглянути звіт</button>
                        </form>
                      @endif
                      
                    </a>
                  @endforeach
              </ul>
            </div>
          </div>
        </div>

        <!-- Modal -->
          <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myHugeModalLabel" aria-hidden="true" id="addlesson-modal">
            <div class="modal-dialog modal-xl mh-100 m-0 border-0 rounded-0 mw-100">
              <div class="modal-content">
                <div class="modal-header background-primary text-white m-0 border-0 rounded-0 p-4">
                  <div class="row w-100">
                    <div class="col-1 col-xs-2">
                      <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-arrow-left color-light-grey"></i></span>
                      </button>
                    </div>
                    <div class="col-10 col-xs-8">
                      <h5 class="modal-title text-center align-middle" id="exampleModalCenteredLabel">Створення заняття</h5>
                    </div>
                  </div>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 text-center">
                      <form method="post" action="{{ route('createlesson') }}">
                        {{ csrf_field() }}
                        <input type="text" class="shadow-lg form-control background-primary border-0 text-white rounded-15 w-100" name="teacher" value="{{Auth::user()->identifier}}" hidden>
                        <div class="form-group m-2">
                          <h4 class="font-primary font-weight-bold mb-3">Інформація про заняття</h4>
                          <div class="row">

                            <div class="offset-md-3 col-md-6 col-xs-12 col-sm-12">
                              <div class="form-group">
                                <h6 class="w-100"><label for="topic" class="ml-2">Тема заняття</label></h6>
                                <input type="text" class="shadow-lg form-control background-primary border-0 text-white rounded-15 w-100 input-dark-grey" id="topic" name="topic">
                              </div>
                            </div>

                          </div>
                          <div class="row mt-3">
                            <div class="offset-md-3 col-md-6 col-xs-12 col-sm-12">
                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                    <h6><label for="discipline" class="ml-2">Предмет</label></h6>
                                    <input type="text" class="form-control background-light-grey border-0 color-dark-grey rounded-15 w-100" id="discipline" name="discipline">
                                  </div>
                                </div>

                                <div class="col-6">
                                  <div class="form-group">
                                    <h6><label for="password" class="ml-2">Код</label></h6>
                                    <input type="text" class="form-control background-light-grey border-0 color-dark-grey rounded-15 w-100" id="password" name="password">
                                  </div>
                                </div>

                                <div class="col-6">
                                  <div class="form-group">
                                    <h6><label for="group" class="ml-2">Група</label></h6>
                                    <select class="custom-select background-light-grey border-0" id="group" name="group">
                                      <option selected disable>Виберіть групу</option>
                                      @foreach (DB::select('SELECT DISTINCT `groupnumber` FROM `students`'); as $group)
                                        <option value="{{ $group->groupnumber }}">{{ $group->groupnumber }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12">
                                  <h4 class="font-primary font-weight-bold text-center mt-3">Тести</h4>
                                  <div class="list-group shadow-lg rounded mw-100">
                                    <a class="list-group-item list-group-item-action list-group-item-light cursor-pointer" id="addquestion">
                                      <h5 class="text-center font-primary font-weight-bold p-2">+ Додати</h5>
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="row mt-3">
                              <div class="offset-md-3 col-md-6 col-xs-12 col-sm-12">
                                <input id="question_count" value="0" name="question_count" hidden>
                                <button class="btn background-primary text-light" type="submit"><span class="font-primary font-weight-bold">Створити заняття</span></button>
                              </div>
                            </div>
                          <hr>
                        </div>

                      </form>
                    </div>

                    <div class="col-md-6 col-xs-12">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <script src="{{ URL::asset('js/lesson.js') }}"></script>


          