<div class="infomation">
    @if($infos->isEmpty())
        <p class="center empty">まだ連絡事項がありません</p>
    @else
        @foreach ($infos as $info)
            @if(Auth::user()->is_joined($info->office_id) || empty($info->office_id))
                <div class="home-content">
                    <p class="small">{{ $info->created_at }}</p>
                    @if(Auth::user()->is_already($info->id))
                        {!! link_to_route('info.show',$info->title,[$info->id]) !!}
                    @else
                        {!! link_to_route('info.show',$info->title,[$info->id],['class'=>'yet']) !!}
                    @endif
                </div>
            @endif
        @endforeach
    @endif

    {{ $infos->links() }}
</div>