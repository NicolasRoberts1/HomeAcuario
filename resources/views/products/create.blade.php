<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-5xl mx-auto sm:px-5 lg:px-5 p-5 flex flex-col items-center">
                    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" class="bg-white flex flex-col w-2/3 py-10 px-10 rounded-xl font-sans">
                        @csrf

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                            {{ __('Nuevo producto') }}
                        </h2>
                        <hr class="mt-5 mb-5">
                        <label for="imagen" class="w-1/2 font-medium text-lg text-gray-600">Imagen:</label>
                        <input type="file" name="imagen" class="font-medium text-lg text-gray-600 rounded-3xl border-gray-600 mt-2">
                        <label for="nombre" class="w-1/2 font-medium text-lg text-gray-600">Nombre:</label>
                        <input type="text" name="nombre" placeholder="Nombre del producto..." max="75" required class="font-medium text-lg text-gray-600 rounded-3xl border-gray-600 mt-2">
                        <label for="descripcion" class="mt-5 font-medium text-lg text-gray-600">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="5" maxlength="150" oninput="updateCounter()" placeholder="Descripcion del producto..." class="font-medium text-lg text-gray-600 rounded-3xl border-gray-600 mt-2" style="resize:none;" required></textarea>
                        <div class="char-counter">
                            <span id="charCount">0</span>/150 caracteres
                        </div> {{--Contador de caracteres del textarea--}}
                        <div class="mt-5 font-medium text-lg text-gray-600 flex justify-between items-center text-center">
                            <label for="cantidad" class="font-medium text-lg text-gray-600">Cantidad:</label>
                            <input type="number" name="cantidad" value="1" required class="w-1/6 font-medium text-lg text-gray-600 rounded-3xl border-gray-600">

                            <label for="precio_minorista" class="font-medium text-lg text-gray-600">Precio Minorista ($):</label>
                            <input type=number name="precio_minorista" step="0.01" placeholder="0.00" required class="w-1/3 font-medium text-lg text-gray-600 rounded-3xl border-gray-600">
                        </div>
                        <div class="mt-5 font-medium text-lg text-gray-600 flex justify-end items-center text-center">
                            <label for="precio_mayorista" class="font-medium text-lg text-gray-600">Precio Mayorista ($):</label>
                            <input type=number name="precio_mayorista" step="0.01" placeholder="0.00" required class="w-1/3 font-medium text-lg text-gray-600 rounded-3xl border-gray-600 ml-4">
                        </div>

                        <div class="mt-7 flex justify-end items-center">
                            <a href="{{route('products')}}" class=" font-medium text-lg text-gray-600">Cancelar</a>
                            <button type="submit" class="font-medium text-lg text-white button cursor-pointer bg-indigo-600 rounded-lg px-3 py-2 text-center hover:bg-indigo-800 ml-5">Agregar</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <script>
        function updateCounter() {
            const textarea = document.getElementById('descripcion');
            const charCount = document.getElementById('charCount');
            charCount.textContent = textarea.value.length;
        }
        document.getElementById('descripcion').addEventListener('input', updateCounter);
        document.addEventListener('DOMContentLoaded', updateCounter);
    </script>
</x-app-layout>
