<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar producto') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><!--class="row"-->
            <!--col-8 offset-2-->
                <div class="max-w-5xl mx-auto sm:px-5 lg:px-5 p-5 flex flex-col">
                    <form action="{{route('products.update', ['product'=>$product->id])}}" method="POST">
                        @csrf
                        @method('put')
                        {{-- <label for="imagen">Imagen:</label>
                        <input type="file" name="imagen"> --}}
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" value="{{$product->nombre}}" max="75" required>
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion" cols="30" rows="5" maxlength="150">{{$product->descripcion}}</textarea>
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" value="{{$product->cantidad}}" required>
                        <label for="precio">Precio Unitario ($):</label>
                        <input type=number name="precio" step="0.01" value="{{$product->precio}}" required>
                        <div class="botonesForm">
                            <a href="{{route('products')}}">Cancelar</a>
                            <button type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</x-app-layout>

