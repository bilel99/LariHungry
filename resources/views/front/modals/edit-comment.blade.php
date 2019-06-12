<!-- Modal -->
<div class="modal fade" id="editCommentModal{{ $row->id }}" tabindex="-1" role="dialog"
     aria-labelledby="editCommentModalLabel{{ $row->id }}"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel{{ $row->id }}">Edit comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('front.comment.update', $row->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="comment">Your comment</label>
                        <textarea
                                class="form-control w-100"
                                name="comment"
                                id="comment"
                                cols="30"
                                rows="9"
                                placeholder="{{ $row->comment }}"
                                required="required"
                                aria-describedby="restaurant.comment restaurant.comment.error">{{ $row->comment }}</textarea>
                        <small id="restaurant.comment"
                               class="form-text text-muted">
                            Your comment!
                        </small>

                        <small id="restaurant.comment.error"
                               class="form-text text-danger">
                            {{ $errors->first('comment') }}
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
