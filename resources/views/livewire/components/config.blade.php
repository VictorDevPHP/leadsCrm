<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="form">
        <div class="form-group">
            <label for="active" class="form-label">Operação</label>
            <select wire:model="active" id="active" class="form-control">
                <option value="true">Ativado</option>
                <option value="false">Desativado</option>
            </select>
            @error('active') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="instruct" class="form-label">Instrução</label>
            <textarea wire:model="instruct" id="instruct" class="form-control summernote"></textarea>
            @error('instruct') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Salvar</button>
    </form>
    <script>
        document.addEventListener('livewire:load', function () {
            $('.summernote').summernote({
                height: 400,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('instruct', contents);
                    }
                }
            });
        });
    </script>
<style>
    .container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #111827;
        color: #1b1b1b;
        flex-direction: column;
    }

    .form {
        background-color: #F3F4F6;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #0f3460;
        color: #eaeaea;
    }

    .form-control:focus {
        outline: none;
        border-color: #00aaff;
    }

    .btn {
        background-color: #00aaff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        text-align: center;
    }

    .btn:hover {
        background-color: #0099dd;
    }

    .error {
        color: #ff3860;
        font-size: 0.875rem;
    }

    .alert-success {
        background-color: #00d1b2;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        max-width: 400px;
    }
</style>
</div>

