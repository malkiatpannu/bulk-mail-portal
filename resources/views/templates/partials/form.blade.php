<div class="mb-3">

    <label>Template Name</label>

    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $template->name ?? '') }}"
           required>

    @error('name')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror

</div>

<div class="mb-3">

    <label>Email Subject</label>

    <input type="text"
           name="subject"
           class="form-control"
           value="{{ old('subject', $template->subject ?? '') }}"
           required>

    @error('subject')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror

</div>

<div class="mb-3">

    <label>Email Body</label>

    <textarea name="body"
              rows="12"
              class="form-control"
              required>{{ old('body', $template->body ?? '') }}</textarea>

    @error('body')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror

</div>

<div class="alert alert-info">

    <strong>Available Placeholders:</strong>

    <hr>

    <div>
        <code>@{{name}}</code>
    </div>

    <div>
        <code>@{{email}}</code>
    </div>

    <div>
        <code>@{{company}}</code>
    </div>

    <div>
        <code>@{{city}}</code>
    </div>

</div>

<button class="btn btn-primary">
    Save Template
</button>
@push('scripts')

<script type="module">

    $(document).ready(function () {

        $('textarea[name="body"]').summernote({
            height: 300
        });

    });

</script>

@endpush