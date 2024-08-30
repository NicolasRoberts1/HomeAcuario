<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo producto') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><!--class="row"-->
            <!--col-8 offset-2-->
                <div class="max-w-5xl mx-auto sm:px-5 lg:px-5 p-5 flex flex-col">
                    <form action="{{route('products.store')}}" method="POST">
                        @csrf
                        {{-- <label for="imagen">Imagen:</label>
                        <input type="file" name="imagen"> --}}
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" placeholder="Nombre del producto..." max="75" required>
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion" cols="30" rows="5" maxlength="150" placeholder="Descripcion del producto..."></textarea>
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" value="1" required>
                        <label for="precio">Precio Unitario ($):</label>
                        <input type=number name="precio" step="0.01" placeholder="0.00" required>
                        <div class="botonesForm">
                            <a href="{{route('products')}}">Cancelar</a>
                            <button type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</x-app-layout>
