<div id="accordion">
    @forelse($faq as $row)
        <div class="card">
            <div class="card-header" id="heading{{$loop->index}}">
                <h5 class="mb-0">
                    <button class="btn btn-link {{ $loop->index !== 0 ? 'collapsed' : '' }}" data-toggle="collapse"
                            data-target="#collapse{{$loop->index}}"
                            aria-expanded="true" aria-controls="collapse{{$loop->index}}">
                        {{ $row->question }}
                    </button>
                </h5>
            </div>

            <div id="collapse{{$loop->index}}" class="collapse {{ $loop->index === 0 ? 'show' : '' }}"
                 aria-labelledby="heading{{$loop->index}}"
                 data-parent="#accordion">
                <div class="card-body">
                    {{ $row->answer }}
                </div>
            </div>
        </div>
    @empty
        <p>Empty FAQ!</p>
    @endforelse
</div>
