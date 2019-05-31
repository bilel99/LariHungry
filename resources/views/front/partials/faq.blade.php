<div id="accordion">
    @if(count($faq) === 0 || $faq === null)
        <p>Empty FAQ!</p>
    @endif
    @foreach($faq as $key => $row)
        <div class="card">
            <div class="card-header" id="heading{{$key}}">
                <h5 class="mb-0">
                    <button class="btn btn-link {{ $key !== 0 ? 'collapsed' : '' }}" data-toggle="collapse"
                            data-target="#collapse{{$key}}"
                            aria-expanded="true" aria-controls="collapse{{$key}}">
                        {{ $row->question }}
                    </button>
                </h5>
            </div>

            <div id="collapse{{$key}}" class="collapse {{ $key === 0 ? 'show' : '' }}" aria-labelledby="heading{{$key}}"
                 data-parent="#accordion">
                <div class="card-body">
                    {{ $row->answer }}
                </div>
            </div>
        </div>
    @endforeach
</div>
