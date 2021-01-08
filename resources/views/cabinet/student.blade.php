<div class="container" style="margin-top:10px;">
  <div class="row">
    <div class="col-xs-12 col-md-6" style="margin-bottom:10px;">
      <div class="card shadow-lg">
        <div class="card-body">
          <h5 class="card-title">{{ DB::table('students')->where('zk_number', Auth::user()->identifier)->value('surname') }} {{ DB::table('students')->where('zk_number', Auth::user()->identifier)->value('name') }}</h5>
          <p class="card-text">Група {{ DB::table('students')->where('zk_number', Auth::user()->identifier)->value('groupnumber') }}</p>
          <p class="card-text">{{ DB::table('students')->where('zk_number', Auth::user()->identifier)->value('speciality') }}</p>
          <div class="list-group shadow-lg rounded" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action list-group-item-dark">Повідомлення</a>
            <a class="list-group-item list-group-item-action list-group-item-dark">Матеріали</a>
            <a class="list-group-item list-group-item-action list-group-item-dark">Налаштування</a>
            <a class="list-group-item list-group-item-action list-group-item-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Вихід</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-md-6">
      <ul class="list-group shadow-lg">
        <li class="list-group-item list-group-item-primary">Поточна пара</li>
        @foreach (DB::select('select * from `lessons` where lesson_group = ? and active = 1', [DB::table('students')->where('zk_number', Auth::user()->identifier)->value('groupnumber')]) as $lesson)
        <a class="list-group-item list-group-item-action rounded-15 shadow-lg"  data-toggle="modal" data-target="#lessonModal_{{$lesson->lesson_id}}">
          <div class="row">
            <div class="col-8">
              <div class="d-flex w-100 justify-content-between">
                  <h5 class="font-weight-bold">{{ $lesson->lesson_topic }}</h5>
              </div>
              <p class="text-muted">{{ $lesson->lesson_discipline }}</p>
              <p class="text-muted">{{ DB::table('teachers')->where('tab_number', $lesson->lesson_teacher)->value('surname') }} {{ DB::table('teachers')->where('tab_number', $lesson->lesson_teacher)->value('name') }} {{ DB::table('teachers')->where('tab_number', $lesson->lesson_teacher)->value('fathername') }}</p>
            </div>
          </div>
        </a>
        
          <div class="modal fade" id="lessonModal_{{$lesson->lesson_id}}" tabindex="-1" role="dialog" aria-labelledby="lessonModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="lessonModalLabel">Введіть код</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('lesson') }}" method="post">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <input type="text" class="form-control" autocomplete="off" name="lessonpass" autofocus>
                    <input type="text" class="form-control" name="lessongroup" value="{{ DB::table('students')->where('zk_number', Auth::user()->identifier)->value('groupnumber') }}" hidden>
                    <input type="text" class="form-control" name="lesson_id" value="{{ $lesson->lesson_id }}" hidden>
                    <input type="text" class="form-control" name="user_id" value="{{ Auth::user()->id }}" hidden>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary col-12">Увійти</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      @endforeach
      </ul>
    </div>
  </div>
</div>