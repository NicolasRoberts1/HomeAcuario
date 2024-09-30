<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="max-w-5xl mx-auto sm:px-5 lg:px-5 p-5 flex flex-col"> --}}
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col md:flex-row justify-center gap-16">
                            <div class="flex flex-col bg-white w-5/12 py-10 px-10 rounded-xl font-sans">

                            <!-- Formulario de pedido -->

                            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                                {{ __('Crear Pedido') }}
                            </h2>

                            <hr class="mt-5 mb-5">

                            <label class="mt-5 font-medium text-lg text-gray-600">Nombre y Apellido del Cliente</label>
                            <input type="text" name="cliente" required class="font-medium text-lg text-gray-600 rounded-3xl border-gray-600 mt-2">

                            <label class="mt-5 font-medium text-lg text-gray-600">Dirección</label>
                            <input type="text" name="direccion" class="font-medium text-lg text-gray-600 rounded-3xl border-gray-600 mt-2">

                            <label class="mt-5 font-medium text-lg text-gray-600">Método de Pago</label>
                            <div class="flex items-center justify-around font-medium text-lg text-gray-600 mt-2">
                                <div>
                                    <input type="radio" name="metodo_pago" value="efectivo" required> Efectivo
                                </div>
                                <div>
                                    <input type="radio" name="metodo_pago" value="transferencia" required> Transferencia
                                </div>
                            </div>

                            <label class="mt-5 font-medium text-lg text-gray-600">Entrega ($)</label>
                            <input type="number" name="entrega" class="font-medium text-lg text-gray-600 rounded-3xl border-gray-600 mt-2">

                            <label class="mt-5 font-medium text-lg text-gray-600">Observaciones</label>
                            <textarea name="observaciones" id="observacion" cols="30" rows="5" maxlength="150" oninput="updateCounter()" placeholder="Observaciones del pedido..." class="font-medium text-lg text-gray-600 rounded-3xl border-gray-600 mt-2 resize-none"></textarea>
                            <div class="char-counter">
                                <span id="charCount">0</span>/150 caracteres
                            </div> {{--Contador de caracteres del textarea--}}
                        </div>

                        <div class="flex flex-col flex-wrap w-1/2">
                            <!-- Selección de productos -->
                            <div class="flex flex-col  mb-8">
                                <label class="mt-5 font-medium text-lg text-gray-600">Seleccionar productos</label>
                                <input type="text" id="searchInput" placeholder="Buscar..." class="font-medium text-lg text-gray-600 rounded-3xl border-gray-600 mt-2">
                            </div>

                            <div class="overflow-x-auto w-full">
                                <table class="min-w-full bg-white border border-gray-300 min-w-full table-auto">
                                  <thead class="bg-gray-200">
                                    <tr>
                                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">ID producto</th>
                                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Imagen</th>
                                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Nombre</th>
                                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Descripción</th>
                                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Precio unitario ($)</th>
                                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Estado</th>
                                      <th class="py-2 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Acción</th>
                                    </tr>
                                  </thead>
                                       <tbody class="border border-gray-400">
                                        @foreach($products as $product)
                                            <tr class="">
                                                <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{ $product->id }}</td>
                                                <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">
                                                    @if($product->imagen)
                                                        <img src="{{ asset('storage/' . $product->imagen) }}" alt="Imagen de {{ $product->nombre }}" class="w-16 h-16 object-cover">
                                                    @else
                                                        No image
                                                    @endif
                                                </td>
                                                <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{ $product->nombre }}</td>
                                                <td class="py-2 px-4 border-b text-sm text-gray-700 text-center break-words">{{ $product->descripcion }}</td>
                                                <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{ $product->precio }}</td>
                                                <td class="py-2 px-4 border-b text-sm text-gray-700 text-center">{{ $product->estado }}</td>
                                                <td class="py-2 px-1 border-b text-sm text-gray-700 text-center items-center">
                                                    <button type="button" class="w-5 h-5 text-center py-0.5" onclick="updateQuantity({{ $product->id }}, -1)">
                                                        <img src="{{ asset('images/minus-circle.ico') }}" alt="-">
                                                    </button>
                                                    <label class="w-8 ml-0.5 mr-0.5 text-center" id="productQuantity-{{ $product->id }}">0</label>
                                                    <button type="button" class="w-5 h-5 text-center py-0.5" onclick="updateQuantity({{ $product->id }}, 1)">
                                                        <img src="{{ asset('images/plus-icon.jpg') }}" alt="+">
                                                    </button>
                                                    <!-- Input oculto para almacenar el id del producto y la cantidad -->
                                                    <input type="hidden" name="products[{{ $product->id }}]" id="productInput-{{ $product->id }}" value="0">
                                                </td>
                                            </tr>
                                        @endforeach
                                       </tbody>
                                </table>
                            </div>
                        </div>

                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="font-medium text-lg text-white button cursor-pointer bg-indigo-600 rounded-lg px-3 py-2 text-center hover:bg-indigo-800 ml-5 mt-5">Agregar Pedido</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- </div> --}}
    </div>
    <script>

        //BARRA DE BUSQUEDA
        document.getElementById('searchInput').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var tableRows = document.querySelectorAll('table tbody tr');

        tableRows.forEach(function(row) {
            var productName = row.querySelector('td:nth-child(3)').innerText.toLowerCase();

            // Si el nombre del producto incluye el texto buscado, mostramos la fila
            if (productName.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
            });
        });

        function debounce(func, delay) {
        let debounceTimer;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        };
    }

    document.getElementById('searchInput').addEventListener('keyup', debounce(function() {
        var input = this.value.toLowerCase();
        var tableRows = document.querySelectorAll('table tbody tr');

        tableRows.forEach(function(row) {
            var productName = row.querySelector('td:nth-child(3)').innerText.toLowerCase();
            if (productName.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }, 300));


    function updateQuantity(productId, change) {
        let quantityLabel = document.getElementById('productQuantity-' + productId);
        let quantityInput = document.getElementById('productInput-' + productId);
        let currentQuantity = parseInt(quantityLabel.innerText);

        // Evitar cantidades negativas
        let newQuantity = currentQuantity + change;
        if (newQuantity >= 0) {
            quantityLabel.innerText = newQuantity;
            quantityInput.value = newQuantity;  // Actualizamos el input oculto con la nueva cantidad
        }
    }


        function updateCounter() {
            const textarea = document.getElementById('observacion');
            const charCount = document.getElementById('charCount');
            charCount.textContent = textarea.value.length;
        }
        document.getElementById('observacion').addEventListener('input', updateCounter);
        document.addEventListener('DOMContentLoaded', updateCounter);
    </script>
</x-app-layout>
