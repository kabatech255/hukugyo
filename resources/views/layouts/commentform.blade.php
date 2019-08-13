<div id="modal_comment" class="hidden py-5">
  <i id="close_form_comment" class="fas fa-times-circle"></i>
  <h2 class="text-muted modal-label">{{ $job->user->name}}さんにコメントします</h2>
  <form class="" action="{{ route('comments.store', ['job' => $job]) }}" method="post">
    {{ csrf_field() }}
      <textarea class="form-control" name="body" rows="4" cols="80" placeholder="コメントを入力してください" required>{{ old('body') }}</textarea>
      <div class="score w-75">
        <p class="text-center">スコアをつける</p>
        <i class="fas fa-star active" data-point="1"></i>
        <i class="fas fa-star active" data-point="2"></i>
        <i class="fas fa-star active" data-point="3"></i>
        <i class="fas fa-star active" data-point="4"></i>
        <i class="fas fa-star active" data-point="5"></i>
      </div>
        <input type="hidden" name="score" value="5">
        <input type="submit" name="button" class="post-comment" value="コメントを投稿する">
  </form>
</div>
