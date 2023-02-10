@if(session('session_success'))
<div class="flashMsg flashMsg--success js-show-flashMsg">
  <p class="flashMsg_text js-get-flashMsg">{{ session('session_success') }}</p>
</div>
@endif
