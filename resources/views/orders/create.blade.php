<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Pedido') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto sm:px-5 lg:px-5 p-5 flex flex-col">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div>
                            <!-- Formulario de pedido -->
                            <label>Nombre y Apellido del Cliente</label>
                            <input type="text" name="cliente" required>

                            <label>Dirección</label>
                            <input type="text" name="direccion">

                            <label>Método de Pago</label>
                            <input type="radio" name="metodo_pago" value="efectivo" required> Efectivo
                            <input type="radio" name="metodo_pago" value="transferencia" required> Transferencia

                            <label>Entrega ($)</label>
                            <input type="number" name="entrega">

                            <label>Observaciones</label>
                            <textarea name="observaciones"></textarea>
                        </div>

                        <div>
                            <!-- Selección de productos -->
                            <label>Seleccionar productos</label>
                            <input type="text" placeholder="Buscar...">
                            <ul>
                                @foreach($products as $product)
                                <li>
                                    <img src="{{ $product->imagen }}" alt="{{ $product->nombre }}">
                                    <span>{{ $product->nombre }}</span>
                                    <span>{{ $product->descripcion }}</span>
                                    <span>${{ $product->precio }}</span>
                                    <input type="number" name="products[{{ $product->id }}]" value="0" min="0">
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <button type="submit">Agregar Pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
