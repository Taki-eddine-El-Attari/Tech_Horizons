<div>
    <div class="form-group">
        <label for="{{ $id ?? $name }}" class="form-label">{{ $label }}</label>
        <textarea 
            class="form-textarea {{ $errors->has($name) ? 'is-invalid' : '' }}"
            id="{{ $id ?? $name }}"
            name="{{ $name }}"

            {{ $attributes }}
        >{{ old($name) ?? $slot }}</textarea>

        @error($name)
            <div class="error-container">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="error-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <span class="error-message">{{ $message }}</span>
            </div> 
        @enderror

        @if ($help)
            <p class="help-text">{{ $help }}</p>
        @endif
    </div>
</div>