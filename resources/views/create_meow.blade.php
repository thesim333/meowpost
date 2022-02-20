@extends('page')

@section('title', 'Post New Meow')

@section('heading', 'What do you want to Meow about today?')

@section('content')
    <main>
        <form id="meowForm">
            <div class="mb-3">
                <label for="meow-content" class="form-label">New Meow</label>
                <textarea id="meow-content" class="form-control" aria-label="New Meow" name="content" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Meow!</button>
        </form>
        <div id="meowFormSuccess" class="alert alert-success mt-2" hidden>
            <span>Meow Posted! 😺</span>
        </div>
        <div id="meowFormError" class="alert alert-warning mt-2" hidden>
            <span>Meow Post Error!</span>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        meowForm.onsubmit = async (event) => {
          event.preventDefault();
          const successBox = document.getElementById('meowFormSuccess');
          const errorBox = document.getElementById('meowFormError');

          if (successBox.hidden) {
            successBox.hidden = true;
          }

          if (!errorBox.hidden) {
              errorBox.hidden = true;
          }

          let response = await fetch('/users/456/meows', {
            method: 'POST',
            body: new FormData(meowForm),
          });

          if (response.ok) {
            successBox.hidden = false;
            meowForm.reset();
          } else {
            errorBox.hidden = false;
          }
        }
    </script>
@endsection
