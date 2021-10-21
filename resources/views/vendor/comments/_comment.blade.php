@inject('markdown', 'Parsedown')
@php
    // TODO: There should be a better place for this.
    $markdown->setSafeMode(true);
@endphp 


    <div class="container" style="background: #f1f1f1;">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                <div class="p-1 bg-white mt-2 rounded" id="comment-{{ $comment->getKey() }}">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row user">
                               
                            <img class="rounded-circle img-fluid img-responsive" src="{{ Storage::url($comment->commenter->path) ?? Storage::url('user/avatar.jpg' ) }} " width="40" >    
                                
                            <div class="d-flex flex-column ml-2"><span class="font-weight-bold">{{ $comment->commenter->name ?? $comment->guest_name }}</span><span class="day" style="font-size: 9px">- {{ $comment->created_at->diffForHumans() }}</span></div>
                        </div>
                    </div>
                    <div class="comment-text text-justify mt-2" style="font-size: 12px;">
                        <p>{!! $markdown->line($comment->comment) !!}</p>
                    </div>
                    <div class="d-flex justify-content-end align-items-center comment-buttons mt-2 text-right">
                        @can('reply-to-comment', $comment)
                            <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link " style="font-size: 13px; color: green;">@lang('comments::comments.reply')</button>
                        @endcan
                        @can('edit-comment', $comment)
                            <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link " style="font-size: 13px; color: green;">@lang('comments::comments.edit')</button>
                        @endcan
                        @can('delete-comment', $comment)
                            <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="mr-3 delete" style="font-size: 13px; color: red;">@lang('comments::comments.delete')</a>
                            <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                        @endcan
                    </div>
                </div>
                
            <div>
            

            @can('edit-comment', $comment)
                <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                                @method('PUT')
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="message">@lang('comments::comments.update_your_message_here')</label>
                                        <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                        <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                    <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.update')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('reply-to-comment', $comment)
                <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                                        <textarea required class="form-control" name="message" rows="3"></textarea>
                                        <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                    <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            <br />{{-- Margin bottom --}}

            <?php
                if (!isset($indentationLevel)) {
                    $indentationLevel = 1;
                } else {
                    $indentationLevel++;
                }
            ?>

            {{-- Recursion for children --}}
            @if($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
                {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
                @foreach($grouped_comments[$comment->getKey()] as $child)
                    @include('comments::_comment', [
                        'comment' => $child,
                        'grouped_comments' => $grouped_comments
                    ])
                @endforeach
            @endif

        </div>
    </div>

    {{-- Recursion for children --}}
    @if($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
        {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
        @foreach($grouped_comments[$comment->getKey()] as $child)
            @include('comments::_comment', [
                'comment' => $child,
                'grouped_comments' => $grouped_comments
            ])
        @endforeach
    @endif






