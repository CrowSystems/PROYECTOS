@csrf

<div class="form-group">
    <label>Título *</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $program->title) }}" required>
    @error('title') <div class="form-error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Resumen corto *</label>
    <input type="text" name="summary" class="form-control" value="{{ old('summary', $program->summary) }}" required maxlength="300">
    @error('summary') <div class="form-error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Descripción completa *</label>
    <textarea name="description" class="form-control" rows="8" required>{{ old('description', $program->description) }}</textarea>
    @error('description') <div class="form-error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label>Imagen (opcional)</label>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if($program->image)
        <p style="margin-top:0.5rem;"><a href="{{ asset('storage/'.$program->image) }}" target="_blank">Ver imagen actual</a></p>
    @endif
    @error('image') <div class="form-error">{{ $message }}</div> @enderror
</div>

<div class="grid cols-3">
    <div class="form-group">
        <label>Orden</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', $program->order ?? 0) }}" min="0">
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $program->is_active ?? true) ? 'checked':'' }}> Activo (visible en el sitio)</label>
    </div>
    <div class="form-group">
        <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $program->is_featured ?? false) ? 'checked':'' }}> Destacado en home</label>
    </div>
</div>

<div style="display:flex;gap:.5rem;">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('admin.programs.index') }}" class="btn btn-danger" style="background:#777;">Cancelar</a>
</div>
