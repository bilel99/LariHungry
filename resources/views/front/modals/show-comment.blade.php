<!-- Modal -->
<div class="modal fade" id="showCommentModal{{ $row->id }}" tabindex="-1" role="dialog"
     aria-labelledby="showCommentModalLabel{{ $row->id }}"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCommentModalLabel{{ $row->id }}">Show Comment {{ $row->id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="show-comment-pres">
                <h3>Vous avez commenté sur l'article du restaurant:</h3>
                    <h4>{{ $row->restaurant->title }}</h4>
                <p class="show-comment-comment">{{ $row->comment }}</p>
            </div>

        </div>
    </div>
</div>
