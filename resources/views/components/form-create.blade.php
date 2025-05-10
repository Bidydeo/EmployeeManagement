<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $form }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route($action) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @foreach ($fields as $field)
                                <div class="col-md-4"> {{-- sau col-md-6 pentru 2 coloane --}}
                                    <div class="form-group">
                                        <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                                        @if ($field['type'] === 'file')
                                            <div class="form-group">
                                                <!-- Container imagine + overlay -->
                                                <div class="image-upload-container">
                                                    <img id="previewImage-{{ $field['name'] }}"
                                                        src="{{ isset($model) && $model->{$field['name']}
                                                            ? asset($model->{$field['name']})
                                                            : asset('storage\placeholder\no-image-placeholder.svg') }}"
                                                        alt="Preview Imagine">
                                                    <!-- Overlay text -->
                                                    <label for="fileInput-{{ $field['name'] }}" class="overlay-text">
                                                        Apasă aici pentru a schimba poza
                                                    </label>

                                                    <!-- Icon zoom -->
                                                    <div class="zoom-icon"
                                                        onclick="zoomImage('{{ 'previewImage-' . $field['name'] }}')">
                                                        +</div>
                                                </div>

                                                <!-- Input file ascuns -->
                                                <input type="file" id="fileInput-{{ $field['name'] }}"
                                                    name="{{ $field['name'] }}"
                                                    accept="image/jpeg, image/png, image/gif, image/tiff"
                                                    style="display: none;">

                                                @error($field['name'])
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @elseif ($field['type'] === 'select')
                                            <select class="form-control" name="{{ $field['name'] }}"
                                                id="{{ $field['name'] }}">
                                                <option value="">Selectează...</option>
                                                @foreach ($field['options'] as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ old($field['name']) == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($field['type'] === 'select-multiple')
                                            <select name="{{ $field['name'] }}[]" id="{{ $field['name'] }}"
                                                class="form-control" multiple>
                                                @if ($field['name'] === 'employees')
                                                    {{-- îl lași gol --}}
                                                @else
                                                    @foreach ($field['options'] as $optionValue => $optionLabel)
                                                        <option value="{{ $optionValue }}">{{ $optionLabel }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @elseif ($field['type'] === 'textarea')
                                            <textarea class="form-control" name="{{ $field['name'] }}" id="{{ $field['name'] }}">{{ old($field['name']) }}</textarea>
                                        @else
                                            <input type="{{ $field['type'] }}" class="form-control"
                                                name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                                                value="{{ old($field['name']) }}"
                                                @if (isset($field['step'])) step="{{ $field['step'] }}" @endif>
                                        @endif
                                        @error($field['name'])
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="submit" value="Create" style="float: right" class="btn btn-outline-primary">
                    </form>
                    <div id="zoomModal">
                        <span id="closeModal"
                            style="position: absolute; top: 10px; right: 20px; font-size: 30px; color: white; cursor: pointer;">&times;</span>
                        <img id="zoomModalImg" src="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
