<div class="mb-3">

    <label>Name</label>

    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $contact->name ?? '') }}"
           required>

    @error('name')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror

</div>

<div class="mb-3">

    <label>Email</label>

    <input type="email"
           name="email"
           class="form-control"
           value="{{ old('email', $contact->email ?? '') }}"
           required>

    @error('email')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror

</div>

<div class="mb-3">

    <label>Phone</label>

    <input type="text"
           name="phone"
           class="form-control"
           value="{{ old('phone', $contact->phone ?? '') }}">

</div>

<hr>

<h5>Dynamic Fields</h5>

<div class="mb-3">

    <label>Company</label>

    <input type="text"
           name="company"
           class="form-control"
           value="{{ old('company', $contact->custom_fields['company'] ?? '') }}">

</div>

<div class="mb-3">

    <label>City</label>

    <input type="text"
           name="city"
           class="form-control"
           value="{{ old('city', $contact->custom_fields['city'] ?? '') }}">

</div>

<button class="btn btn-primary">
    Save Contact
</button>