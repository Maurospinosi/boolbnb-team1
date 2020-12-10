@foreach ($housesToPrint as $house_info)
<div class="card">
    <div class="card-body">
        <div class="card_img">
            <img src="{{cover_image}}" alt="cover picture">
        </div>
        <div class="card_text">
            <h5 class="card-title">{{$house_info->title}}</h5>
            <h6>{{$house_info->price}}€</h6>
            <button type="button" class="btn btn-scopri">
                <a href="
                    @if (Auth::id() == $house_info->house->user_id)
                        {{route("host/house.show", $house_info->house->id)}}
                    @else
                        {{route("guest/house", $house_info->house->slug)}}
                    @endif">Scopri
                </a>
            </button>
        </div>
        @if(count($house_info->house->tags) > 0)
        <div class="card_badges">
            <i class="fas fa-tags"></i>
                @foreach($tags as $tag)
                    @if ($house_info->house->tags->contains($tag))
                        <span class="badge badge-light">{{$tag->name}}</span>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
@endforeach
