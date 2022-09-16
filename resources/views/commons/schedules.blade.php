
    @if($schedules->isEmpty())
        <p class="center empty">予定を登録してください。</p>
    @else
        @foreach ($schedules as $schedule)
           

            <div class="schedule-wrap">
                <div class="schedule container">
                    <p class="days">{{ $schedule->date }}</p>
                    <p class="schedules-text"><i class="fas fa-clock"></i>{{ $schedule->time}}</p>
                    <p class="schedules-text">{{ $schedule->content }}</p>
                </div>
                
                <div class="schedules-edit-icons">
                    {{ Form::open(['route'=>['schedule.delete',$schedule->id],'method'=>'delete']) }}  
                        {{ Form::submit('削除',['class'=>'delete']) }}
                    {{ Form::close() }}

                    {{ Form::open(['route'=>['schedule.edit',$schedule->id],'method'=>'get']) }}  
                        {{ Form::submit('編集',['class'=>'edit']) }}
                    {{ Form::close() }}

                    
                </div>
            </div>
        @endforeach

    @endif
