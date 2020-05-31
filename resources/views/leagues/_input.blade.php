<div class="form-group">
    <label for="{{ $name }}">{{ $Name }}</label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $league->$name) }}" class="form-control bg-light shadow-sm @error('{{ $name }}') is-invalid @enderror"> 
    @error('{{ $name }}') 
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>